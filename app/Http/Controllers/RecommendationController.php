<?php

namespace App\Http\Controllers;

use App\Models\HairAssessment;
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
        ]);
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
