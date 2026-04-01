<?php

namespace App\Filament\Resources\Reviews\Tables;

use App\Models\Review;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state))
                    ->html()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('comment')
                    ->limit(50)
                    ->searchable(),
                ImageColumn::make('images')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->size(32),
                IconColumn::make('is_verified_purchase')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),
                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),        
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('rating')
                    ->options([
                        5 => '5 Stars',
                        4 => '4 Stars',
                        3 => '3 Stars',
                        2 => '2 Stars',
                        1 => '1 Star',
                    ]),
                TernaryFilter::make('is_approved')
                    ->label('Approved'),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
                TernaryFilter::make('is_verified_purchase')
                    ->label('Verified Purchase'),
                SelectFilter::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('approve')
                ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Review $record) => $record->update(['is_approved' => true]))
                    ->visible(fn (Review $record) => !$record->is_approved),
                Action::make('feature')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->action(fn (Review $record) => $record->update(['is_featured' => !$record->is_featured]))
                    ->label(fn (Review $record) => $record->is_featured ? 'Unfeature' : 'Feature'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('approveSelected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each->update(['is_approved' => true])),
                ]),
            ]);
    }
}
