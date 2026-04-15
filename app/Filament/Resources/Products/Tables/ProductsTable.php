<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->square()->size(50),
                TextColumn::make('name')->searchable()->sortable()->limit(30),
                TextColumn::make('category.name')->sortable()->badge(),
                TextColumn::make('brand')->searchable(),
                TextColumn::make('price')->money('INR')->sortable(),
                TextColumn::make('old_price')->money('INR')->sortable(),
                TextColumn::make('discount')->suffix('%')->color('success')->sortable(),
                SelectColumn::make('stock')->options([
                    'available' => 'Available',
                    'low' => 'Low',
                    'out_of_stock' => 'Out of Stock',
                ]),
                IconColumn::make('is_best_seller')->boolean(),
                IconColumn::make('is_trending')->boolean(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->name ?? 'Unnamed Category #' . ($record->id ?? 'Unknown');
                    }),

                SelectFilter::make('brand')
                    ->options(fn () => Product::distinct()->pluck('brand', 'brand')->filter()->toArray())
                    ->searchable(),

                SelectFilter::make('stock')
                    ->options([
                        'available' => 'Available',
                        'low' => 'Low Stock',
                        'out_of_stock' => 'Out of Stock',
                    ]),

                TernaryFilter::make('is_best_seller')->label('Best Seller'),
                TernaryFilter::make('is_trending')->label('Trending'),
                TernaryFilter::make('is_active')->label('Active'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}