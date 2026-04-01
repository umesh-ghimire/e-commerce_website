<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FooterSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Company Information')
                    ->schema([
                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('logo')
                            ->image()
                            ->directory('footer')
                            ->imageResizeMode('cover')
                            ->maxSize(1024),
                        Textarea::make('company_description')
                            ->rows(3)
                            ->columnSpanFull(),  
                        ])->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->maxLength(255),
                        Textarea::make('address')
                            ->rows(2)
                            ->maxLength(500),
                    ])->columns(2),  
                 Section::make('Newsletter Settings')
                    ->schema([
                        Toggle::make('show_newsletter')
                            ->label('Show Newsletter Form')
                            ->default(true),
                        TextInput::make('newsletter_title')
                            ->maxLength(255)
                            ->default('Subscribe to our newsletter'),
                        Textarea::make('newsletter_description')
                            ->rows(2)
                            ->maxLength(500),
                    ])->columns(2),
                Section::make('Copyright & Colors')
                    ->schema([
                        TextInput::make('copyright_text')
                            ->maxLength(255)
                            ->default('All Rights Reserved by PrimeHub'),
                        TextInput::make('primary_color')
                            ->type('color')
                            ->default('#166534'),
                        TextInput::make('secondary_color')
                            ->type('color')
                            ->default('#1f2937'),
                    ])->columns(2),                            
            ]);
    }
}
