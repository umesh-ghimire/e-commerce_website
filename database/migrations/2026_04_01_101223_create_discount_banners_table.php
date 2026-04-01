<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('background_color')->nullable()->default('#1f2937');
            $table->string('text_color')->nullable()->default('#ffffff');
            $table->integer('discount_percentage')->default(70);
            $table->string('button_text')->default('Shop Now');
            $table->string('button_link')->default('/products');
            $table->string('cashback_text')->nullable();
            $table->integer('cashback_amount')->nullable();
            $table->integer('minimum_purchase')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_banners');
    }
};