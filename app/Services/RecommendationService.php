<?php

namespace App\Services;

use App\Models\HairAssessment;
use App\Models\Products;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Batas harga per kategori budget.
     * Sesuaikan dengan rentang harga dataset kamu.
     */


    /**
     * Entry point utama.
     * Dipanggil dari controller dengan assessment yang sudah ada.
     *
     * @return Collection  koleksi produk dengan tambahan field:
     *                     similarity_score, matched_ingredients, match_details
     */
    public function recommend(HairAssessment $assessment, int $topN = 10): Collection
    {
        // Kumpulkan semua problem_id dari assessment ini
        // (gabungan hair_problems + scalp_conditions yang diperlakukan sebagai masalah)
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return collect();
        }

        // Cache key unik per kombinasi masalah + budget
        // sehingga kombinasi yang sama tidak dihitung ulang
        $cacheKey = 'recommendation_' . implode('_', $problemIds->sort()->values()->toArray())
                    . '_' . $assessment;

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($problemIds, $assessment, $topN) {
            return $this->compute($problemIds, $topN);
        });
    }

    /**
     * Rekomendasikan produk beserta evaluasi metrik.
     * Mengembalikan array ['recommendations' => Collection, 'evaluation' => array]
     */
    public function recommendWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.6): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return [
                'recommendations' => collect(),
                'evaluation' => [
                    'precision_at_k' => 0,
                    'recall_at_k'    => 0,
                    'f1_score'       => 0,
                    'k'              => $topN,
                    'threshold'      => $threshold,
                    'relevant_in_topk'  => 0,
                    'total_relevant'    => 0,
                    'total_products'    => 0,
                ],
            ];
        }

        // Hitung semua skor produk (tanpa limit)
        $allScored = $this->computeAll($problemIds);

        // Ambil top-K rekomendasi
        $recommendations = $allScored
            ->filter(fn($p) => $p->similarity_score > 0)
            ->sortByDesc('similarity_score')
            ->take($topN)
            ->values();

        // Hitung evaluasi
        $evaluation = $this->evaluate($recommendations, $allScored, $topN, $threshold);

        return [
            'recommendations' => $recommendations,
            'evaluation'      => $evaluation,
        ];
    }

    /**
     * Hitung rekomendasi tanpa cache — untuk keperluan debug / admin.
     */
    public function computeFresh(HairAssessment $assessment, int $topN = 10): Collection
    {
        $problemIds = $this->resolveProblemIds($assessment);
        return $this->compute($problemIds,  $topN);
    }

    /**
     * Hitung ulang tanpa cache, beserta evaluasi.
     */
    public function computeFreshWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.6): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return [
                'recommendations' => collect(),
                'evaluation' => [
                    'precision_at_k' => 0,
                    'recall_at_k'    => 0,
                    'f1_score'       => 0,
                    'k'              => $topN,
                    'threshold'      => $threshold,
                    'relevant_in_topk'  => 0,
                    'total_relevant'    => 0,
                    'total_products'    => 0,
                ],
            ];
        }

        $allScored = $this->computeAll($problemIds);

        $recommendations = $allScored
            ->filter(fn($p) => $p->similarity_score > 0)
            ->sortByDesc('similarity_score')
            ->take($topN)
            ->values();

        $evaluation = $this->evaluate($recommendations, $allScored, $topN, $threshold);

        return [
            'recommendations' => $recommendations,
            'evaluation'      => $evaluation,
        ];
    }

    // ---------------------------------------------------------------
    // PRIVATE METHODS
    // ---------------------------------------------------------------

    /**
     * Gabungkan hair_problem_id dari hair_problems dan scalp_conditions
     * yang terhubung ke assessment ini.
     */
    private function resolveProblemIds(HairAssessment $assessment): Collection
    {
        // Ambil masalah rambut yang dipilih
        $hairProblemIds = $assessment->hairProblems()->pluck('hair_problems.id');

        // Scalp conditions yang dipilih (Berminyak, Kering, Iritasi, Normal)
        // dipetakan ke hair_problem_id yang ekuivalen di tabel hair_problems
        // Contoh: scalp 'Berminyak' → hair_problem 'Kulit Kepala Berminyak' (id=3)
        $scalpToHairProblem = [
            'Berminyak' => 3,  // Kulit Kepala Berminyak
            'Kering'    => 4,  // Kulit Kepala Kering
            'Iritasi'   => 13, // Kulit Kepala Iritasi
            // 'Normal' tidak dipetakan — tidak ada masalah spesifik
        ];

        $scalpProblemIds = $assessment->scalpConditions()
            ->pluck('scalp_conditions.name')
            ->map(fn($name) => $scalpToHairProblem[$name] ?? null)
            ->filter();

        return $hairProblemIds->merge($scalpProblemIds)->unique()->values();
    }

    /**
     * Inti perhitungan weighted cosine similarity.
     */
    private function compute(Collection $problemIds,  int $topN): Collection
    {
        return $this->computeAll($problemIds)
            ->filter(fn($p) => $p->similarity_score > 0)
            ->sortByDesc('similarity_score')
            ->take($topN)
            ->values();
    }

    /**
     * Hitung similarity score untuk SEMUA produk (tanpa filter/limit).
     * Digunakan oleh compute() dan evaluate().
     */
    private function computeAll(Collection $problemIds): Collection
    {
        // Step 1: Bangun vektor Q
        $vectorQ = $this->buildQueryVector($problemIds);

        if (empty($vectorQ)) {
            return collect();
        }

        // Pre-hitung magnitude |Q| = sqrt( Σ Qᵢ² )
        $magnitudeQ = sqrt(array_sum(array_map(fn($q) => $q * $q, $vectorQ)));

        // Step 2: Ambil semua produk + key_ingredients dalam 1 query
        $products = $this->fetchProducts();

        // Step 3: Hitung similarity tiap produk
        return $products->map(function (Products $product) use ($vectorQ, $magnitudeQ) {
            [$score, $matchedIngredients] = $this->cosineSimilarity($product, $vectorQ, $magnitudeQ);

            $product->similarity_score    = round($score, 4);
            $product->matched_ingredients = $matchedIngredients;

            return $product;
        });
    }

    /**
     * Evaluasi hasil rekomendasi menggunakan Precision@K, Recall@K, dan F1-Score.
     *
     * Ground truth: produk dianggap relevan jika similarity_score >= threshold.
     *
     * Precision@K = Relevant items in Top-K / K
     * Recall@K    = Relevant items in Top-K / Total relevant items
     * F1-Score    = 2 × (Precision@K × Recall@K) / (Precision@K + Recall@K)
     */
    private function evaluate(Collection $topK, Collection $allScored, int $k, float $threshold): array
    {
        // Hitung jumlah produk relevan di top-K (similarity_score >= threshold)
        $relevantInTopK = $topK->filter(fn($p) => $p->similarity_score >= $threshold)->count();

        // Hitung TOTAL produk relevan di seluruh database
        $totalRelevant = $allScored->filter(fn($p) => $p->similarity_score >= $threshold)->count();

        // Total produk yang dinilai
        $totalProducts = $allScored->count();

        // K yang digunakan (bisa lebih kecil dari topN jika produk yang ada kurang)
        $actualK = $topK->count();

        // Precision@K = Relevant items in Top-K / K
        $precisionAtK = $actualK > 0 ? $relevantInTopK / $actualK : 0;

        // Recall@K = Relevant items in Top-K / Total relevant items
        $recallAtK = $totalRelevant > 0 ? $relevantInTopK / $totalRelevant : 0;

        // F1-Score = 2 × (Precision × Recall) / (Precision + Recall)
        $f1Score = ($precisionAtK + $recallAtK) > 0
            ? 2 * ($precisionAtK * $recallAtK) / ($precisionAtK + $recallAtK)
            : 0;

        return [
            'precision_at_k'    => round($precisionAtK, 4),
            'recall_at_k'       => round($recallAtK, 4),
            'f1_score'          => round($f1Score, 4),
            'k'                 => $actualK,
            'threshold'         => $threshold,
            'relevant_in_topk'  => $relevantInTopK,
            'total_relevant'    => $totalRelevant,
            'total_products'    => $totalProducts,
        ];
    }

    /**
     * Bangun vektor Q dari daftar problem_id.
     * Jika satu ingredient muncul di beberapa masalah → ambil priority tertinggi.
     *
     * Return: [ 'ingredient name lowercase' => priority ]
     */
    private function buildQueryVector(Collection $problemIds): array
    {
        $rows = DB::table('problem_ingredient_map as pim')
            ->join('ingredients as i', 'i.id', '=', 'pim.ingredient_id')
            ->whereIn('pim.hair_problem_id', $problemIds)
            ->select('i.name', 'pim.priority', 'pim.hair_problem_id')
            ->get();

        $vector = [];
        foreach ($rows as $row) {
            $name = strtolower(trim($row->name));
            // Ambil priority tertinggi jika ingredient muncul di lebih dari 1 masalah
            if (! isset($vector[$name]) || $row->priority > $vector[$name]) {
                $vector[$name] = (int) $row->priority;
            }
        }

        return $vector;
    }

    /**
     * Ambil semua produk, filter berdasarkan budget.
     * Eager-load category agar tidak ada N+1.
     */
    private function fetchProducts(): Collection
    {
       

        return Products::with('category')
            ->get();
    }

    /**
     * Hitung cosine similarity antara vektor Q dan satu produk.
     *
     * Nilai P untuk tiap ingredient:
     *   - Jika ingredient ada di key_ingredients produk → Pᵢ = priorityᵢ dari Q
     *   - Jika tidak ada                               → Pᵢ = 0
     *
     * similarity = Σ(Qᵢ × Pᵢ) / ( |Q| × |P| )
     *
     * @return array [float $similarity, array $matchedIngredients]
     */
    private function parseFullIngredients(?string $raw): array
{
    if (empty($raw)) return [];

    return array_map(
        fn($s) => strtolower(trim($s)),
        explode(',', $raw)
    );
}
    private function cosineSimilarity(Products $product, array $vectorQ, float $magnitudeQ): array
    {
        // Parse key_ingredients produk dari JSON string
        $keyIngredients = $this->parseKeyIngredients($product->key_ingredients);
        //dd($keyIngredients);

        if (empty($keyIngredients)) {
            return [0.0, []];
        }

        $dotProduct     = 0.0;
        $magnitudePSq   = 0.0;
        $matchedDetails = [];

        foreach ($vectorQ as $ingName => $qPriority) {
            // Cek apakah ingredient ini ada di produk (matching lowercase)
            $pValue = in_array($ingName, $keyIngredients) ? $qPriority : 0;

            $dotProduct   += $qPriority * $pValue;
            $magnitudePSq += $pValue * $pValue;

            if ($pValue > 0) {
                $matchedDetails[] = [
                    'ingredient' => $ingName,
                    'priority'   => $qPriority,
                ];
            }
        }

        if ($magnitudeQ == 0 || $magnitudePSq == 0) {
            return [0.0, []];
        }

        $magnitudeP  = sqrt($magnitudePSq);
        $similarity  = $dotProduct / ($magnitudeQ * $magnitudeP);

        return [min($similarity, 1.0), $matchedDetails];
    }

    /**
     * Parse kolom key_ingredients dari JSON string ke array lowercase.
     * Contoh input: '["Piroctone Olamine", "Glycerin"]'
     * Output: ['piroctone olamine', 'glycerin']
     */
   /**
     * Parse kolom key_ingredients ke array lowercase.
     * Mampu menangani format JSON standar maupun representasi string array Python (contoh: "['bahan a', 'bahan b']")
     */
    private function parseKeyIngredients(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        // 1. Coba decode secara standar dulu (berjaga-jaga jika ada data yang memang JSON valid)
        $decoded = json_decode($raw, true);

        // 2. Jika gagal di-decode (karena bukan JSON standar, misal pakai kutip tunggal)
        if (! is_array($decoded)) {
            // Bersihkan string dari kurung siku di awal/akhir
            $cleanString = trim($raw, "[] \t\n\r\0\x0B"); 
            
            // Hapus semua tanda kutip tunggal maupun ganda
            $cleanString = str_replace(["'", '"'], "", $cleanString); 
            
            // Pecah menjadi array berdasarkan tanda koma
            $decoded = explode(',', $cleanString);
            
            // Buang elemen array yang kosong (misal akibat ada koma ganda berlebih)
            $decoded = array_filter($decoded, fn($val) => trim($val) !== '');
        }

        // 3. Pastikan hasil akhir dikembalikan dalam bentuk lowercase dan tidak ada spasi di awal/akhir kata
        if (is_array($decoded) && !empty($decoded)) {
            return array_map(fn($s) => strtolower(trim($s)), $decoded);
        }

        return [];
    }
}
