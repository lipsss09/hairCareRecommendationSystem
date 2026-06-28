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
     * Nilai 0.4 artinya skor cosine bisa naik maksimal 40%.
     */
    // private const MAX_PRIORITY_BOOST = 0.4;

    // /**
    //  * Boost per bahan yang cocok berdasarkan priority.
    //  */
    // private const BOOST_PER_PRIORITY = [
    //     3 => 0.2, // +5% per bahan priority 3
    //     2 => 0.1, // +2% per bahan priority 2
    //     1 => 0.00, // tidak ada boost untuk priority 1
    // ];

    // ---------------------------------------------------------------
    // PUBLIC METHODS
    // ---------------------------------------------------------------

    /**
     * Entry point utama dengan cache.
     */
    // public function recommend(HairAssessment $assessment, int $topN = 10): Collection
    // {
    //     $problemIds = $this->resolveProblemIds($assessment);

    //     if ($problemIds->isEmpty()) {
    //         return collect();
    //     }

    //     // FIX #1: gunakan $assessment->budget bukan $assessment (object tidak bisa jadi string)
    //     $cacheKey = 'recommendation_'
    //         . implode('_', $problemIds->sort()->values()->toArray())
    //         . '_' . $assessment;

    //     return Cache::remember($cacheKey, now()->addHours(6), function () use ($problemIds, $topN) {
    //         return $this->compute($problemIds, $topN);
    //     });
    // }

    /**
     * Rekomendasikan produk beserta evaluasi metrik.
     * Mengembalikan array ['recommendations' => Collection, 'evaluation' => array, 'has_feedback' => bool]
     */
    public function recommendWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.6): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return $this->emptyEvaluationResult($topN, $threshold);
        }

        $allScored = $this->computeAll($problemIds);

        return $this->resolveRecommendationsAndEvaluation($assessment, $allScored, $topN, $threshold);
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
    public function computeFreshWithEvaluation(HairAssessment $assessment, int $topN = 10, float $threshold = 0.4): array
    {
        $problemIds = $this->resolveProblemIds($assessment);

        if ($problemIds->isEmpty()) {
            return $this->emptyEvaluationResult($topN, $threshold);
        }

        $allScored = $this->computeAll($problemIds);

        return $this->resolveRecommendationsAndEvaluation($assessment, $allScored, $topN, $threshold);
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

        // $scalpToHairProblem = [
        //     'Berminyak' => 3,
        //     'Kering'    => 4,
        //     'Iritasi'   => 13,
        // ];

        $scalpProblemIds = $assessment->scalpConditions()
            ->pluck('scalp_conditions.name')
            ->map(fn($name) => $scalpToHairProblem[$name] ?? null)
            ->filter();

        return $hairProblemIds->merge($scalpProblemIds)->unique()->values();// penggabungan masalah rambut dan kulit kepala 
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
    
    // Ambil mapping ingredient → priority dari DB (untuk semua problem yang relevan)
    $ingredientPriorityMap = $this->buildIngredientPriorityMap($problemIds);

    $products = $this->fetchProducts();

    return $products->map(function (Products $product) use ($vectorQ, $magnitudeQ, $ingredientPriorityMap) {
        [$score, $matchedIngredients] = $this->cosineSimilarity($product, $vectorQ, $magnitudeQ, $ingredientPriorityMap);

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
     * Selesaikan rekomendasi dan evaluasi berdasarkan ketersediaan feedback user.
     */
    private function resolveRecommendationsAndEvaluation(HairAssessment $assessment, Collection $allScored, int $topN, float $threshold): array
    {
        $feedbacks = $assessment->relevanceEvaluations;

        if ($feedbacks && $feedbacks->isNotEmpty()) {
            $productIds = $feedbacks->pluck('product_id')->toArray();
            $feedbackMap = $feedbacks->pluck('is_relevant', 'product_id')->toArray();
            $scoreMap = $feedbacks->pluck('similarity_score', 'product_id')->toArray();
            $allScoredMap = $allScored->keyBy('id');
            $recommendations = Products::with('category')
                ->whereIn('id', $productIds)
                ->get()
                ->map(function ($product) use ($scoreMap, $feedbackMap,$allScoredMap) {
                    $product->similarity_score = (float) ($scoreMap[$product->id] ?? 0.0);
                    $product->is_relevant = (bool) ($feedbackMap[$product->id] ?? false);
                    $product->matched_ingredients = isset($allScoredMap[$product->id]) 
                    ? $allScoredMap[$product->id]->matched_ingredients : [];
                    return $product;
                })
                ->sortByDesc('similarity_score')
                ->values();

            $evaluation = $this->evaluateUserFeedback($recommendations, $allScored, $topN, $threshold);

            return [
                'recommendations' => $recommendations,
                'evaluation'      => $evaluation,
                'has_feedback'    => true,
            ];
        }

        $recommendations = $allScored
            ->filter(fn($p) => $p->similarity_score > 0)
            ->sortByDesc('similarity_score')
            ->take($topN)
            ->values();

        $evaluation = $this->evaluate($recommendations, $allScored, $topN, $threshold);

        return [
            'recommendations' => $recommendations,
            'evaluation'      => $evaluation,
            'has_feedback'    => false,
        ];
    }

    /**
     * Evaluasi Precision@K, Recall@K, F1-Score menggunakan feedback nyata dari user.
     */
    private function evaluateUserFeedback(Collection $topK, Collection $allScored, int $k, float $threshold): array
    {
        $relevantInTopK = $topK->filter(fn($p) => $p->is_relevant === true)->count();
        $totalRelevantThreshold = $allScored->filter(fn($p) => $p->similarity_score >= $threshold)->count();
        
        // Sesuaikan total_relevant agar tidak kurang dari $relevantInTopK untuk mencegah Recall > 1.0
        $totalRelevant = max($totalRelevantThreshold, $relevantInTopK);
        $totalProducts = $allScored->count();
        $actualK = $topK->count();

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
 * Bangun map: ingredient_name → priority tertinggi dari semua problem yang relevan.
 * Ini adalah "vector referensi" untuk matching dengan produk.
 */
private function buildIngredientPriorityMap(Collection $problemIds): array
{
    $rows = DB::table('problem_ingredient_map as pim')
        ->join('ingredients as i', 'i.id', '=', 'pim.ingredient_id')
        ->whereIn('pim.hair_problem_id', $problemIds)
        ->select('i.name', 'pim.priority')
        ->get();

    $map = [];
    foreach ($rows as $row) {
        $name = strtolower(trim($row->name));
        // Jika ingredient muncul di beberapa problem, ambil priority tertinggi
        if (!isset($map[$name]) || $row->priority > $map[$name]) {
            $map[$name] = (int) $row->priority;
        }
    }

    return $map;
}
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
                $vector[$name] = 3;
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
 * Cosine similarity yang benar:
 * - vectorQ: semua ingredient relevan, nilai 3
 * - vectorP: ingredient produk (dari key_ingredients) di-lookup ke ingredientPriorityMap
 * - Dot product hanya dihitung jika ingredient ada di KEDUA vector
 */
private function cosineSimilarity(Products $product, array $vectorQ, float $magnitudeQ, array $ingredientPriorityMap): array
{
    $productIngredients = $this->parseKeyIngredients($product->key_ingredients);

    if (empty($productIngredients)) {
        return [0.0, []];
    }

    // Bangun vectorP: ingredient produk yang ada di mapping → pakai priority dari DB
    $vectorP = [];
    foreach ($productIngredients as $ingName) {
        $name = strtolower(trim($ingName));
        if (isset($ingredientPriorityMap[$name])) {
            $vectorP[$name] = $ingredientPriorityMap[$name]; // priority dari DB
        }
    }

    // Hitung dot product dan magnitude P
    // Hanya ingredient yang ada di KEDUA vector yang berkontribusi ke dot product
    $dotProduct     = 0.0;
    $magnitudePSq   = 0.0;
    $matchedDetails = [];
    

    foreach ($vectorP as $ingName => $pPriority) {
        $magnitudePSq += $pPriority * $pPriority;

        if (isset($vectorQ[$ingName])) {
            // Ingredient cocok → kontribusi ke dot product
            $qPriority    = $vectorQ[$ingName]; // selalu 3
            $dotProduct  += $qPriority * $pPriority;

            $matchedDetails[] = [
                'ingredient' => $ingName,
                'priority'   => $pPriority,
            ];
        }
    }

    if ($magnitudeQ == 0 || $magnitudePSq == 0) {
        return [0.0, []];
    }
    
    

    $magnitudeP = sqrt($magnitudePSq);
    
    $cosine     = $dotProduct / ($magnitudeQ * $magnitudeP);
    // dd($magnitudeQ,$magnitudeQ,$dotProduct,$cosine);

    return [min(round($cosine, 4), 1.0), $matchedDetails];
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