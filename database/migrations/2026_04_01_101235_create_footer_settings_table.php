<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('PrimeHub');
            $table->text('company_description')->nullable();
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('copyright_text')->default('© 2024 PrimeHub. All rights reserved.');
            $table->string('newsletter_title')->default('Subscribe to our newsletter');
            $table->text('newsletter_description')->nullable();
            $table->boolean('show_newsletter')->default(true);
            $table->string('primary_color')->default('#166534');
            $table->string('secondary_color')->default('#1f2937');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};