<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('problem_ingredient_map', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hair_problem_id')->constrained('hair_problems')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
            $table->unsignedTinyInteger('priority'); // 1 = bonus, 2 = direkomendasikan, 3 = sangat direkomendasikan
            $table->timestamps();

            $table->unique(['hair_problem_id', 'ingredient_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('problem_ingredient_map');
    }
};
