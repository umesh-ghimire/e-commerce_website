<?php
// app/Filament/Resources/EmailSettings/Schemas/EmailSettingForm.php

namespace App\Filament\Resources\EmailSettings\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;

class EmailSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Email Configuration')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('e.g., smtp_host, mail_from_address'),
                        
                        Select::make('type')
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'password' => 'Password',
                                'email' => 'Email',
                                'number' => 'Number',
                            ])
                            ->required()
                            ->default('text'),
                        
                        Textarea::make('value')
                            ->label('Value')
                            ->required()
                            ->columnSpanFull(),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->helperText('What is this setting used for?')
                            ->columnSpanFull(),
                        
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }
}