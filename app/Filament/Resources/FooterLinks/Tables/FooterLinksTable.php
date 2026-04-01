<?php

namespace App\Filament\Resources\FooterLinks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FooterLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('section')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'department' => 'info',
                        'about' => 'success',
                        'services' => 'warning',
                        'bottom_links' => 'primary',
                        'legal' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('url')
                    ->searchable()
                    ->limit(30)
                    ->copyable(),
                TextColumn::make('icon')
                    ->searchable(),
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
                SelectFilter::make('section')
                    ->options([
                        'department' => 'Department',
                        'about' => 'About Us',
                        'services' => 'Services',
                        'bottom_links' => 'Bottom Bar Links',
                        'legal' => 'Legal Links',
                    ]),
                SelectFilter::make('is_active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
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
