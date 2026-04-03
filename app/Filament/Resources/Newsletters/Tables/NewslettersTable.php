<?php
// app/Filament/Resources/Newsletters/Tables/NewslettersTable.php

namespace App\Filament\Resources\Newsletters\Tables;

use App\Models\Newsletter;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NewslettersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied'),
                
                IconColumn::make('is_subscribed')
                    ->label('Subscribed')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                TextColumn::make('subscribed_at')
                    ->label('Subscribed On')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                
                TextColumn::make('unsubscribed_at')
                    ->label('Unsubscribed On')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('is_subscribed')
                    ->label('Status')
                    ->options([
                        '1' => 'Subscribed',
                        '0' => 'Unsubscribed',
                    ]),
                
                Filter::make('subscribed_today')
                    ->label('Subscribed Today')
                    ->query(fn (Builder $query): Builder => $query->whereDate('subscribed_at', today())),
                
                Filter::make('recent_unsubscribed')
                    ->label('Recent Unsubscribed')
                    ->query(fn (Builder $query): Builder => $query->whereDate('unsubscribed_at', '>=', now()->subDays(7))),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ActionsAction::make('send_email')
                    ->label('Send Email')
                    ->icon('heroicon-o-envelope')
                    ->color('primary')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('subject')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->action(function (array $data, Newsletter $record): void {
                        // Send email logic here
                        \Illuminate\Support\Facades\Mail::raw($data['content'], function ($message) use ($record, $data) {
                            $message->to($record->email)
                                    ->subject($data['subject']);
                        });
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Email sent successfully!')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    \Filament\Actions\BulkAction::make('export')
                        ->label('Export CSV')
                        ->icon('heroicon-o-document-arrow-down')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            // Export logic
                            $csv = \League\Csv\Writer::new();
                            $csv->insertOne(['Email', 'Status', 'Subscribed At']);
                            
                            foreach ($records as $record) {
                                $csv->insertOne([
                                    $record->email,
                                    $record->is_subscribed ? 'Subscribed' : 'Unsubscribed',
                                    $record->subscribed_at,
                                ]);
                            }
                            
                            return response()->streamDownload(function () use ($csv) {
                                echo $csv->toString();
                            }, 'newsletter_export.csv');
                        }),
                ]),
            ]);
    }
}