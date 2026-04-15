<?php

namespace App\Filament\Resources\Roles\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('permissions_count')
                    ->counts('permissions')
                    ->label('Permissions'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}