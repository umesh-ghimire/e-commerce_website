<?php

namespace App\Filament\Resources\DiscountBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DiscountBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->rows(2)
                            ->maxLength(500),
                        FileUpload::make('image')
                            ->image()
                            ->directory('banners')
                            ->imageResizeMode('cover')
                            ->maxSize(2048),
                    ])->columns(2),
                Section::make('Discount & Cashback')
                    ->schema([
                        TextInput::make('discount_percentage')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(70)
                            ->suffix('%'),
                        TextInput::make('cashback_text')
                            ->maxLength(255)
                            ->placeholder('Get 5% Cash back'),
                        TextInput::make('cashback_amount')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('₹'),
                        TextInput::make('minimum_purchase')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('₹'),
                    ])->columns(2),    
                Section::make('Button & Settings')
                    ->schema([
                        TextInput::make('button_text')
                            ->required()
                            ->default('Shop Now')
                            ->maxLength(255),
                        TextInput::make('button_link')
                            ->required()
                            ->default('/products')
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->default(true),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])->columns(2),    
            ]);
    }
}
