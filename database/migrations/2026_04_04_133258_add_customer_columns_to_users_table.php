<?php
// database/migrations/2026_04_04_000000_add_customer_columns_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add columns only if they don't exist
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('gender');
            }
            
            if (!Schema::hasColumn('users', 'preferences')) {
                $table->json('preferences')->nullable()->after('remember_token');
            }
            
            if (!Schema::hasColumn('users', 'deletion_requested_at')) {
                $table->timestamp('deletion_requested_at')->nullable()->after('preferences');
            }
            
            if (!Schema::hasColumn('users', 'deletion_reason')) {
                $table->text('deletion_reason')->nullable()->after('deletion_requested_at');
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 
                'gender', 
                'date_of_birth', 
                'preferences', 
                'deletion_requested_at', 
                'deletion_reason'
            ]);
        });
    }
};