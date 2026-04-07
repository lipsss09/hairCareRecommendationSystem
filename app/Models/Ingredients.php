<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredients extends Model
{
    protected $fillable = ['ingredient_id', 'name'];

    public function hairProblems(): BelongsToMany
    {
        return $this->belongsToMany(
            HairProblem::class,
            'problem_ingredient_map',
            'ingredient_id',
            'hair_problem_id'
        )->withPivot('priority');
    }
}