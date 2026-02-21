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
        Schema::create('hair_assessment_scalp_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hair_assessment_id')
                  ->constrained('hair_assessments')
                  ->onDelete('cascade');
            $table->foreignId('scalp_condition_id')
                  ->constrained('scalp_conditions')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hair_assessment_scalp_conditions');
    }
};
