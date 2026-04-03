<?php
// database/migrations/2026_01_01_000002_add_welcome_back_fields_to_users.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add welcome-back tracking field
            if (!Schema::hasColumn('users', 'last_welcome_back_sent_at')) {
                $table->timestamp('last_welcome_back_sent_at')->nullable()->after('last_activity_at');
            }
            
            // Add reward points field
            if (!Schema::hasColumn('users', 'points')) {
                $table->integer('points')->default(0)->after('last_welcome_back_sent_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_welcome_back_sent_at', 'points']);
        });
    }
};