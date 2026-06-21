<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relevance_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hair_assessment_id')
                  ->constrained('hair_assessments')
                  ->onDelete('cascade');
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
            $table->boolean('is_relevant');
            $table->decimal('similarity_score', 5, 4)->nullable();
            $table->timestamps();

            // Ensure unique combination of assessment and product feedback
            $table->unique(['hair_assessment_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relevance_evaluations');
    }
};
