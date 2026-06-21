<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\HairAssessment;
use App\Models\RelevanceEvaluation;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function __construct(private RecommendationService $service) {}

    /**
     * Tampilkan hasil rekomendasi untuk assessment tertentu.
     * Route: GET /recommendations/{assessment}
     */
    public function show(HairAssessment $assessment)
    {
        // Pastikan assessment milik user yang sedang login
        abort_if($assessment->user_id !== auth()->id(), 403);

        $result = $this->service->recommendWithEvaluation($assessment, topN: 10, threshold: 0.6);

        return view('recommendations.show', [
            'assessment'      => $assessment->load(['hairProblems', 'scalpConditions']),
            'recommendations' => $result['recommendations'],
            'evaluation'      => $result['evaluation'],
            'has_feedback'    => $result['has_feedback'] ?? false,
            'categories'      => Categories::all(),
        ]);
    }

    /**
     * Hitung ulang tanpa cache — untuk keperluan debug (opsional, bisa dihapus di production).
     * Route: GET /recommendations/{assessment}/refresh
     */
    public function refresh(HairAssessment $assessment)
    {
        abort_if($assessment->user_id !== auth()->id(), 403);

        $result = $this->service->computeFreshWithEvaluation($assessment, topN: 10, threshold: 0.6);

        return view('recommendations.show', [
            'assessment'      => $assessment->load(['hairProblems', 'scalpConditions']),
            'recommendations' => $result['recommendations'],
            'evaluation'      => $result['evaluation'],
            'has_feedback'    => $result['has_feedback'] ?? false,
            'categories'      => Categories::all(),
        ]);
    }

    /**
     * Simpan evaluasi relevansi produk dari user.
     * Route: POST /recommendation/{assessment}/evaluate
     */
    public function storeEvaluation(Request $request, HairAssessment $assessment)
    {
        // Pastikan assessment milik user yang sedang login
        abort_if($assessment->user_id !== auth()->id(), 403);

        // Jika sudah pernah dievaluasi, abaikan
        if ($assessment->relevanceEvaluations()->exists()) {
            return redirect()->route('recommendation.show', $assessment)
                ->with('error', 'Evaluasi untuk rekomendasi ini sudah disimpan.');
        }

        // Ambil produk yang direkomendasikan saat ini agar bisa memvalidasi feedback yang masuk
        $result = $this->service->recommendWithEvaluation($assessment, topN: 10, threshold: 0.6);
        $recommendedProducts = $result['recommendations'];

        // Validasi input
        $rules = [
            'relevance' => 'required|array|size:' . $recommendedProducts->count(),
        ];
        
        foreach ($recommendedProducts as $product) {
            $rules["relevance.{$product->id}"] = 'required|in:0,1';
        }

        $validated = $request->validate($rules, [
            'relevance.required' => 'Evaluasi relevansi produk wajib diisi.',
            'relevance.array' => 'Data evaluasi tidak valid.',
            'relevance.size' => 'Semua produk rekomendasi harus dievaluasi relevansinya.',
            'relevance.*.required' => 'Setiap produk rekomendasi wajib dievaluasi relevansinya.',
            'relevance.*.in' => 'Pilihan relevansi harus berupa Relevan atau Tidak Relevan.',
        ]);

        // Simpan ke database
        foreach ($recommendedProducts as $product) {
            $isRelevant = (bool) $validated['relevance'][$product->id];
            
            RelevanceEvaluation::create([
                'hair_assessment_id' => $assessment->id,
                'product_id'         => $product->id,
                'is_relevant'        => $isRelevant,
                'similarity_score'   => $product->similarity_score,
            ]);
        }

        return redirect()->route('recommendation.show', $assessment)
            ->with('success', 'Evaluasi Anda berhasil disimpan! Metrik evaluasi sistem kini dihitung berdasarkan feedback Anda.');
    }

    /**
     * Tampilkan history rekomendasi (Evaluasi) untuk user saat ini.
     * Route: GET /evaluasi
     */
    public function history()
    {
        $assessments = auth()->user()->hairAssessments()
                             ->with(['hairProblems', 'scalpConditions'])
                             ->latest()
                             ->get();

        return view('recommendations.history', compact('assessments'));
    }
}
