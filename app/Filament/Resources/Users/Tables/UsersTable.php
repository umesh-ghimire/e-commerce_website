<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc') // 🚀 performance + UX

            ->columns([
                ImageColumn::make('avatar')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->searchable(debounce: 500)
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(debounce: 500)
                    ->copyable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->color('success')
                    ->sortable(),    

                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->getStateUsing(fn ($record) => !is_null($record->email_verified_at))
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle'),

                TextColumn::make('google_id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('facebook_id')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->since() // 👈 human readable
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('verification')
                    ->options([
                        'verified' => 'Verified',
                        'unverified' => 'Unverified',
                    ])
                    ->query(function ($query, $state) {
                        return match ($state) {
                            'verified' => $query->whereNotNull('email_verified_at'),
                            'unverified' => $query->whereNull('email_verified_at'),
                            default => $query,
                        };
                    }),

                SelectFilter::make('provider')
                    ->options([
                        'google' => 'Google',
                        'facebook' => 'Facebook',
                    ])
                    ->query(function ($query, $state) {
                        return match ($state) {
                            'google' => $query->whereNotNull('google_id'),
                            'facebook' => $query->whereNotNull('facebook_id'),
                            default => $query,
                        };
                    }),
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