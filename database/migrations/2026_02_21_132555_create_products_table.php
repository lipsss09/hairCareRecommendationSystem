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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_id')->unique();
            $table->string('name');
            $table->string('brand');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('price');
            $table->integer('size');
            $table->string('size_unit');
            $table->text('ingredients');
            $table->text('key_ingredients')->nullable();
            $table->string('image_url')->nullable();
            $table->text('source');
            $table->date('collected_date');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
