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
     * Batas maksimal priority boost agar skor tidak meledak.
     * Nilai 0.3 artinya skor cosine bisa naik maksimal 30%.
     */
    private const MAX_PRIORITY_BOOST = 0.3;

    /**
     * Boost per bahan yang cocok berdasarkan priority.
     */
    private const BOOST_PER_PRIORITY = [
        3 => 0.2, // +5% per bahan priority 3
        2 => 0.1, // +2% per bahan priority 2
        1 => 0.00, // tidak ada boost untuk priority 1
    ];

    // ---------------------------------------------------------------
    // PUBLIC METHODS
    // ---------------------------------------------------------------

    /**
     * Entry point utama dengan cache.
     */
    public function recommend(HairAssessment $assessment, int $topN = 10): Collection
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return collect();
        }

        // FIX #1: gunakan $assessment->budget bukan $assessment (object tidak bisa jadi string)
        $cacheKey = 'recommendation_'
            . implode('_', $problemIds->sort()->values()->toArray())
            . '_' . $assessment;

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($problemIds, $topN) {
            return $this->compute($problemIds, $topN);
        });
    }

    /**
     * Rekomendasikan produk beserta evaluasi metrik.
     * Mengembalikan array ['recommendations' => Collection, 'evaluation' => array]
     */
    public function recommendWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.3): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return $this->emptyEvaluationResult($topN, $threshold);
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

    /**
     * Hitung rekomendasi tanpa cache — untuk keperluan debug / admin.
     */
    public function computeFresh(HairAssessment $assessment, int $topN = 10): Collection
    {
        $problemIds = $this->resolveProblemIds($assessment);
        return $this->compute($problemIds, $topN);
    }

    /**
     * Hitung ulang tanpa cache, beserta evaluasi.
     */
    public function computeFreshWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.3): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return $this->emptyEvaluationResult($topN, $threshold);
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
     * Gabungkan hair_problem_id dari hair_problems dan scalp_conditions.
     */
    private function resolveProblemIds(HairAssessment $assessment): Collection
    {
        $hairProblemIds = $assessment->hairProblems()->pluck('hair_problems.id');

        $scalpToHairProblem = [
            'Berminyak' => 3,
            'Kering'    => 4,
            'Iritasi'   => 13,
        ];

        $scalpProblemIds = $assessment->scalpConditions()
            ->pluck('scalp_conditions.name')
            ->map(fn($name) => $scalpToHairProblem[$name] ?? null)
            ->filter();

        return $hairProblemIds->merge($scalpProblemIds)->unique()->values();
    }

    /**
     * Compute top-N produk.
     */
    private function compute(Collection $problemIds, int $topN): Collection
    {
        return $this->computeAll($problemIds)
            ->filter(fn($p) => $p->similarity_score > 0)
            ->sortByDesc('similarity_score')
            ->take($topN)
            ->values();
    }

    /**
     * Hitung similarity untuk SEMUA produk tanpa filter/limit.
     */
    private function computeAll(Collection $problemIds): Collection
    {
        $vectorQ = $this->buildQueryVector($problemIds);

        if (empty($vectorQ)) {
            return collect();
        }

        $magnitudeQ = sqrt(array_sum(array_map(fn($q) => $q * $q, $vectorQ)));

        $products = $this->fetchProducts();

        return $products->map(function (Products $product) use ($vectorQ, $magnitudeQ) {
            [$score, $matchedIngredients] = $this->cosineSimilarity($product, $vectorQ, $magnitudeQ);

            $product->similarity_score    = round($score, 4);
            $product->matched_ingredients = $matchedIngredients;

            return $product;
        });
    }

    /**
     * Evaluasi Precision@K, Recall@K, F1-Score.
     * Ground truth: produk relevan jika similarity_score >= threshold.
     *
     * Precision@K = Relevant items in Top-K / K
     * Recall@K    = Relevant items in Top-K / Total relevant items
     * F1-Score    = 2 × (Precision × Recall) / (Precision + Recall)
     */
    private function evaluate(Collection $topK, Collection $allScored, int $k, float $threshold): array
    {
        $relevantInTopK = $topK->filter(fn($p) => $p->similarity_score >= $threshold)->count();
        $totalRelevant  = $allScored->filter(fn($p) => $p->similarity_score >= $threshold)->count();
        $totalProducts  = $allScored->count();
        $actualK        = $topK->count();

        $precisionAtK = $actualK > 0 ? $relevantInTopK / $actualK : 0;
        $recallAtK    = $totalRelevant > 0 ? $relevantInTopK / $totalRelevant : 0;

        $f1Score = ($precisionAtK + $recallAtK) > 0
            ? 2 * ($precisionAtK * $recallAtK) / ($precisionAtK + $recallAtK)
            : 0;

        return [
            'precision_at_k'   => round($precisionAtK, 4),
            'recall_at_k'      => round($recallAtK, 4),
            'f1_score'         => round($f1Score, 4),
            'k'                => $actualK,
            'threshold'        => $threshold,
            'relevant_in_topk' => $relevantInTopK,
            'total_relevant'   => $totalRelevant,
            'total_products'   => $totalProducts,
        ];
    }

    /**
     * Bangun vektor Q.
     * Jika ingredient muncul di beberapa masalah → ambil priority tertinggi.
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
            if (! isset($vector[$name]) || $row->priority > $vector[$name]) {
                $vector[$name] = (int) $row->priority;
            }
        }

        return $vector;
    }

    /**
     * Ambil semua produk dengan eager load category.
     */
    private function fetchProducts(): Collection
    {
        return Products::with('category')->get();
    }

    /**
     * Hitung cosine similarity standar + priority boost yang dibatasi.
     *
     * Formula dasar:
     *   cosine = Σ(Qᵢ × Pᵢ) / (|Q| × |P|)
     *
     * Priority Boost (teknik penyesuaian skor berbasis bobot kandungan):
     *   boost = Σ BOOST_PER_PRIORITY[priority] per bahan yang cocok
     *   boost dibatasi maksimal MAX_PRIORITY_BOOST
     *
     * Skor akhir:
     *   score_final = min(cosine × (1 + boost), 1.0)
     *
     * Justifikasi: produk yang mengandung bahan aktif berprioritas tinggi
     * secara klinis lebih direkomendasikan, sehingga layak mendapat
     * penyesuaian skor positif yang proporsional dan terbatas.
     *
     * @return array [float $similarity, array $matchedIngredients]
     */
    private function cosineSimilarity(Products $product, array $vectorQ, float $magnitudeQ): array
    {
        // FIX #2: gunakan parseFullIngredients (full ingredient list)
        // bukan parseKeyIngredients — lebih akurat karena mencakup semua bahan produk
        $productIngredients = $this->parseKeyIngredients($product->key_ingredients);

        if (empty($productIngredients)) {
            return [0.0, []];
        }

        $dotProduct     = 0.0;
        $magnitudePSq   = 0.0;
        $matchedDetails = [];
        $totalBoost     = 0.0;

        foreach ($vectorQ as $ingName => $qPriority) {
            $pValue = in_array($ingName, $productIngredients) ? $qPriority : 0;

            $dotProduct   += $qPriority * $pValue;
            $magnitudePSq += $pValue * $pValue;

            if ($pValue > 0) {
                $matchedDetails[] = [
                    'ingredient' => $ingName,
                    'priority'   => $qPriority,
                ];

                // Akumulasi boost — dibatasi MAX_PRIORITY_BOOST
                $boostIncrement = self::BOOST_PER_PRIORITY[$qPriority] ?? 0;
                $totalBoost     = min($totalBoost + $boostIncrement, self::MAX_PRIORITY_BOOST);
            }
        }

        if ($magnitudeQ == 0 || $magnitudePSq == 0) {
            return [0.0, []];
        }

        // Cosine similarity standar
        $magnitudeP = sqrt($magnitudePSq);
        $cosine     = $dotProduct / ($magnitudeQ * $magnitudeP);

        // Terapkan priority boost yang sudah dibatasi
        $similarity = $cosine * (1.0 + $totalBoost);

        return [min($similarity, 1.0), $matchedDetails];
    }

    /**
     * Parse kolom ingredients (full list) — dipisah koma.
     * Digunakan untuk matching karena lebih lengkap dari key_ingredients.
     */
    private function parseFullIngredients(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        return array_map(
            fn($s) => strtolower(trim($s)),
            explode(',', $raw)
        );
    }

    /**
     * Parse kolom key_ingredients dari JSON string ke array lowercase.
     * Handle format JSON standar dan representasi string Python array.
     * Dipertahankan untuk keperluan lain jika diperlukan.
     */
    private function parseKeyIngredients(?string $raw): array
    {
        if (empty($raw)) {
            return [];
        }

        $decoded = json_decode($raw, true);

        if (! is_array($decoded)) {
            $cleanString = trim($raw, "[] \t\n\r\0\x0B");
            $cleanString = str_replace(["'", '"'], '', $cleanString);
            $decoded     = explode(',', $cleanString);
            $decoded     = array_filter($decoded, fn($val) => trim($val) !== '');
        }

        if (is_array($decoded) && ! empty($decoded)) {
            return array_map(fn($s) => strtolower(trim($s)), $decoded);
        }

        return [];
    }

    /**
     * Helper untuk mengembalikan struktur evaluasi kosong.
     */
    private function emptyEvaluationResult(int $topN, float $threshold): array
    {
        return [
            'recommendations' => collect(),
            'evaluation' => [
                'precision_at_k'   => 0,
                'recall_at_k'      => 0,
                'f1_score'         => 0,
                'k'                => $topN,
                'threshold'        => $threshold,
                'relevant_in_topk' => 0,
                'total_relevant'   => 0,
                'total_products'   => 0,
            ],
        ];
    }
}