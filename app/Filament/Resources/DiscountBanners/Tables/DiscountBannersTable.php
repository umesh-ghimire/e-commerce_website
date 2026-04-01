<?php

namespace App\Filament\Resources\DiscountBanners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DiscountBannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('discount_percentage')
                    ->suffix('%')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('button_text')
                    ->searchable(),
                TextColumn::make('button_link')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ColorColumn::make('background_color')
                    ->copyable(),
                ColorColumn::make('text_color')
                    ->copyable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('order')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),    
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteBulkAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
