<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        FileUpload::make('logo')
                            ->image()
                            ->directory('payment-methods')
                            ->imageResizeMode('cover')
                            ->maxSize(1024)
                            ->helperText('Upload payment method logo (eSewa, Khalti, etc.)'),    
                        Textarea::make('description')
                            ->rows(2)
                            ->maxLength(500),
                        ])->columns(2),
                        Section::make('QR Code Settings (For Digital Wallets)')
                    ->schema([
                        FileUpload::make('qr_code')
                            ->image()
                            ->directory('payment-qr-codes')
                            ->imageResizeMode('cover')
                            ->maxSize(2048)
                            ->helperText('Upload QR code image for this payment method'),
                        TextInput::make('merchant_id')
                            ->maxLength(255)
                            ->helperText('Merchant ID or Phone number for this payment method'),
                        Textarea::make('instructions')
                            ->rows(3)
                            ->placeholder('Step by step payment instructions...')
                            ->helperText('Payment instructions to show customers'),
                    ])->columns(2),

                Section::make('Payment Limits & Charges')
                    ->schema([
                        TextInput::make('min_amount')
                            ->numeric()
                            ->prefix('₹')
                            ->default(0)
                            ->helperText('Minimum order amount for this payment method'),
                        TextInput::make('max_amount')
                            ->numeric()
                            ->prefix('₹')
                            ->nullable()
                            ->helperText('Maximum order amount (leave empty for no limit)'),
                        TextInput::make('additional_charge')
                            ->numeric()
                            ->prefix('₹')
                            ->default(0)
                            ->helperText('Additional processing fee (if any)'),
                    ])->columns(2),

                Section::make('Status & Order')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first in checkout'),
                    ])->columns(2),   

            ]);
    }
}
