<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HairAssessment extends Model
{
    use HasFactory;

    protected $table = 'hair_assessments';

    protected $fillable = [
        'user_id',
        'hair_type',
        'budget',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi many-to-many ke ScalpCondition
     */
    public function scalpConditions()
    {
        return $this->belongsToMany(
            ScalpCondition::class,
            'hair_assessment_scalp_conditions',
            'hair_assessment_id',
            'scalp_condition_id'
        );
    }

    /**
     * Relasi many-to-many ke HairProblem
     */
    public function hairProblems()
    {
        return $this->belongsToMany(
            HairProblem::class,
            'hair_assessment_hair_problems',
            'hair_assessment_id',
            'hair_problem_id'
        );
    }

    /**
     * Relasi ke RelevanceEvaluation
     */
    public function relevanceEvaluations()
    {
        return $this->hasMany(RelevanceEvaluation::class, 'hair_assessment_id');
    }
}