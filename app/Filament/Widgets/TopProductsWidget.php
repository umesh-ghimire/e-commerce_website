<?php
// app/Filament/Widgets/TopProductsWidget.php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Product;

class TopProductsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->withCount('orderItems as total_sold')
                    ->withSum('orderItems as total_revenue', 'price')
                    ->orderByDesc('total_sold')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(25),
                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Units Sold')
                    ->numeric(),
                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Revenue')
                    ->money('INR'),
            ]);
    }
    
    protected function getTableHeading(): string
    {
        return 'Top Products';
    }
}