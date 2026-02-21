<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HairProblem extends Model
{
    use HasFactory;

    protected $table = 'hair_problems';

    protected $fillable = ['name'];

    /**
     * Relasi many-to-many ke HairAssessment
     */
    public function hairAssessments()
    {
        return $this->belongsToMany(
            HairAssessment::class,
            'hair_assessment_hair_problems',
            'hair_problem_id',
            'hair_assessment_id'
        );
    }
}
