<?php
// database/migrations/2026_01_01_000010_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->string('type')->default('info');
            $table->boolean('is_read')->default(false);
            $table->json('data')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'is_read', 'created_at']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};