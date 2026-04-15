<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add missing boolean columns with defaults
            if (!Schema::hasColumn('products', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('is_active');
            }
            if (!Schema::hasColumn('products', 'is_new')) {
                $table->boolean('is_new')->default(false)->after('is_featured');
            }
            if (!Schema::hasColumn('products', 'is_trending')) {
                $table->boolean('is_trending')->default(false)->after('is_new');
            }
            if (!Schema::hasColumn('products', 'is_best_seller')) {
                $table->boolean('is_best_seller')->default(false)->after('is_trending');
            }
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 3, 2)->default(0)->after('is_best_seller');
            }
            if (!Schema::hasColumn('products', 'old_price')) {
                $table->decimal('old_price', 12, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'is_featured', 'is_new', 'is_trending', 
                'is_best_seller', 'rating', 'old_price', 'slug'
            ]);
        });
    }
};