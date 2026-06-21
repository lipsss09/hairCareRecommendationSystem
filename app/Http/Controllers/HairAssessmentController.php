<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HairAssessment;
use App\Models\ScalpCondition;
use App\Models\HairProblem;
use Illuminate\Support\Facades\Auth;

class HairAssessmentController extends Controller
{
    /**
     * Tampilkan form input masalah rambut
     */
    public function create()
    {
        $scalpConditions = ScalpCondition::all();
        $hairProblems    = HairProblem::all();

        return view('content.hairProblem', compact('scalpConditions', 'hairProblems'));
    }

    /**
     * Simpan data assessment ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'hair_type'         => 'required|in:bergelombang,lurus,keriting',
            'hair_problem'      => 'required|array|min:1',
            'hair_problem.*'    => 'exists:hair_problems,id',
          
        ], [
            'hair_type.required'       => 'Silakan pilih tipe rambut Anda.',
            'hair_problem.required'    => 'Silakan pilih minimal satu masalah rambut.',
            'hair_problem.min'         => 'Silakan pilih minimal satu masalah rambut.',
        
        ]);

        // Simpan hair assessment utama
        $assessment = HairAssessment::create([
            'user_id'  => Auth::id(),
            'hair_type' => $request->hair_type,
           
        ]);
        $now = now();
        // Simpan ke pivot table scalp conditions
        $assessment->scalpConditions()->attach($request->scalp_condition, ['created_at' => $now, 'updated_at' => $now]);

        // Simpan ke pivot table hair problems
        $assessment->hairProblems()->attach($request->hair_problem, ['created_at' => $now, 'updated_at' => $now]);

        // Redirect ke halaman rekomendasi
        return redirect()->route('recommendation.show', $assessment->id)
                         ->with('success', 'Data rambut berhasil disimpan!');
    }
}