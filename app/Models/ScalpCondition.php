<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScalpCondition extends Model
{
    use HasFactory;

    protected $table = 'scalp_conditions';

    protected $fillable = ['name'];

    /**
     * Relasi many-to-many ke HairAssessment
     */
    public function hairAssessments()
    {
        return $this->belongsToMany(
            HairAssessment::class,
            'hair_assessment_scalp_conditions',
            'scalp_condition_id',
            'hair_assessment_id'
        );
    }
}
