<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Order Information Section
                TextInput::make('order_number')
                    ->required()
                    ->default('ORD-' . Str::random(8))
                    ->disabled()
                    ->dehydrated(true),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'confirmed' => 'Confirmed',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ])
                    ->required()
                    ->native(false),

                // Payment Details Section
                Select::make('payment_method')
                    ->options([
                        'cod' => 'Cash on Delivery',
                        'card' => 'Credit/Debit Card',
                        'bank_transfer' => 'Bank Transfer',
                        'mobile_payment' => 'Mobile Payment',
                    ])
                    ->required(), 
                 Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->required(), 
                FileUpload::make('payment_proof')
                    ->image()
                    ->directory('payment-proofs')
                    ->visibility('private')
                    ->downloadable(),
                Textarea::make('payment_notes')
                    ->rows(3),
                DateTimePicker::make('payment_verified_at')
                    ->label('Payment Verified At'),
                    
                // Amounts Section
                TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01),
                TextInput::make('tax')
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01)
                    ->default(0),
                TextInput::make('shipping')
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01)
                    ->default(0),  
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01),
                    
                // Addresses Section
                Textarea::make('shipping_address')
                    ->required()
                    ->rows(3),
                Textarea::make('billing_address')
                    ->rows(3),
                Textarea::make('notes')
                    ->rows(2),    
            ]);
    }
}
