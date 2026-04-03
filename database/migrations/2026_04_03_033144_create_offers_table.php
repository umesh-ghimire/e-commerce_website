<?php
// database/migrations/2026_01_01_000003_create_offers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->decimal('discount', 5, 2);
            $table->enum('type', ['percentage', 'fixed'])->default('percentage');
            $table->timestamp('expires_at');
            $table->boolean('is_active')->default(true);
            $table->timestamp('used_at')->nullable();
            $table->timestamps();
            
            // Add index for faster queries
            $table->index(['code', 'is_active']);
            $table->index('expires_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};