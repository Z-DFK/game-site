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
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->text('price')->comment('Цена игры');
            $table->string('image');
            $table->string('colour')->comment('Цвет игры');
            $table->boolean('is_active');
            $table->boolean('is_popular');
            $table->string('weight')->comment('Вес товара');
            $table->string('material')->comment('Материал товара');
            $table->string('name')->comment('Название игры');
            $table->text('description')->comment('Описание игры');
            $table->timestamps();
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
