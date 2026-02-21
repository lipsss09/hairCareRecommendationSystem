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
        Schema::table('hair_assessments', function (Blueprint $table) {
            $table->dropColumn(['scalp_condition', 'hair_problem']);
        });
        Schema::create('scalp_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('hair_problems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
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
        Schema::create('hair_assessment_hair_problems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hair_assessment_id')
                  ->constrained('hair_assessments')
                  ->onDelete('cascade');
            $table->foreignId('hair_problem_id')
                  ->constrained('hair_problems')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hair_assessments', function (Blueprint $table) {
            $table->enum('scalp_condition', ['berminyak', 'iritasi', 'kering', 'normal'])->after('hair_type');
            $table->enum('hair_problem', ['rambut_rontok', 'ketombe', 'lepek'])->after('scalp_condition');
        });
    }
};
