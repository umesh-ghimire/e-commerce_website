<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'Cash on Delivery',
            'slug' => 'cash_on_delivery',
            'description' => 'Pay with cash when your order is delivered',
            'instructions' => 'Keep exact change ready for the delivery person.',
            'min_amount' => 0,
            'max_amount' => 50000,
            'additional_charge' => 0,
            'is_active' => true,
            'order' => 1,
        ]);

        PaymentMethod::create([
            'name' => 'eSewa',
            'slug' => 'esewa',
            'description' => 'Pay securely using eSewa digital wallet',
            'instructions' => "1. Open eSewa app\n2. Scan the QR code\n3. Enter amount and confirm payment\n4. Upload screenshot as proof",
            'merchant_id' => 'primehub@esewa',
            'min_amount' => 10,
            'max_amount' => 100000,
            'additional_charge' => 0,
            'is_active' => true,
            'order' => 2,
        ]);

        PaymentMethod::create([
            'name' => 'Khalti',
            'slug' => 'khalti',
            'description' => 'Pay securely using Khalti digital wallet',
            'instructions' => "1. Open Khalti app\n2. Scan the QR code\n3. Enter amount and confirm payment\n4. Upload screenshot as proof",
            'merchant_id' => 'primehub@khalti',
            'min_amount' => 10,
            'max_amount' => 100000,
            'additional_charge' => 0,
            'is_active' => true,
            'order' => 3,
        ]);
    }
}