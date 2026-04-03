<?php
// app/Filament/Resources/Newsletters/Schemas/NewsletterForm.php

namespace App\Filament\Resources\Newsletters\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class NewsletterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Subscriber Information')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->required()
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        
                        Toggle::make('is_subscribed')
                            ->label('Subscribed')
                            ->default(true)
                            ->helperText('Toggle to subscribe/unsubscribe'),
                        
                        DateTimePicker::make('subscribed_at')
                            ->label('Subscribed At')
                            ->default(now())
                            ->helperText('When the user subscribed'),
                        
                        DateTimePicker::make('unsubscribed_at')
                            ->label('Unsubscribed At')
                            ->helperText('When the user unsubscribed (if applicable)'),
                    ]),
            ]);
    }
}