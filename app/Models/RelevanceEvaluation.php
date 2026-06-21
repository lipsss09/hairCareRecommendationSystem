<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelevanceEvaluation extends Model
{
    use HasFactory;

    protected $table = 'relevance_evaluations';

    protected $fillable = [
        'hair_assessment_id',
        'product_id',
        'is_relevant',
        'similarity_score',
    ];

    /**
     * Relationship to HairAssessment.
     */
    public function hairAssessment()
    {
        return $this->belongsTo(HairAssessment::class, 'hair_assessment_id');
    }

    /**
     * Relationship to Product.
     */
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
