<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // eSewa, Khalti, Cash on Delivery
            $table->string('slug')->unique(); // esewa, khalti, cash_on_delivery
            $table->string('logo')->nullable();
            $table->string('qr_code')->nullable(); // QR code image for digital wallets
            $table->string('merchant_id')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->decimal('min_amount', 10, 2)->default(0);
            $table->decimal('max_amount', 10, 2)->nullable();
            $table->decimal('additional_charge', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};