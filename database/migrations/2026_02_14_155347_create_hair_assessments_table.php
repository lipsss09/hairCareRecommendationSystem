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
        Schema::create('hair_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->enum('hair_type', ['bergelombang', 'lurus', 'keriting']);
            $table->enum('scalp_condition', ['berminyak', 'iritasi', 'kering', 'normal']);
            $table->enum('hair_problem', ['rambut_rontok', 'ketombe', 'lepek']);
            $table->enum('budget', ['terjangkau', 'medium', 'premium']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hair_assessments');
    }
};