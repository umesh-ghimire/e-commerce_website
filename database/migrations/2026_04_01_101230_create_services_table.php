<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('background_color')->nullable()->default('#f0f9ff');
            $table->string('text_color')->nullable()->default('#1e3a8a');
            $table->string('button_text')->default('Learn More');
            $table->string('button_link')->default('/products');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};