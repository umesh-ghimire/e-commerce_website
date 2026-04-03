<?php
// app/Filament/Resources/EmailLogs/Tables/EmailLogsTable.php

namespace App\Filament\Resources\EmailLogs\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmailLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'welcome' => 'success',
                        'welcome_back' => 'warning',
                        'newsletter' => 'info',
                        default => 'secondary',
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sent' => 'success',
                        'failed' => 'danger',
                        'pending' => 'warning',
                        default => 'secondary',
                    }),
                TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('sent_at', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'welcome' => 'Welcome',
                        'welcome_back' => 'Welcome Back',
                        'newsletter' => 'Newsletter',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'sent' => 'Sent',
                        'failed' => 'Failed',
                    ]),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}