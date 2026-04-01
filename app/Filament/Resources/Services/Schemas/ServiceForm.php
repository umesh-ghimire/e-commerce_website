<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->rows(3)
                    ->maxLength(500),
                FileUpload::make('icon')
                    ->image()
                    ->directory('services')
                    ->imageResizeMode('cover')
                    ->maxSize(512),
                TextInput::make('icon_class')
                    ->maxLength(100)
                    ->helperText('FontAwesome icon class (e.g., fas fa-question-circle)'),
                TextInput::make('background_color')
                    ->type('color')
                    ->default('#f0f9ff'),
                TextInput::make('text_color')
                    ->type('color')
                    ->default('#1e3a8a'),
                TextInput::make('button_text')
                    ->required()
                    ->default('Learn More')
                    ->maxLength(255),
                TextInput::make('button_link')
                    ->required()
                    ->default('/products')
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->default(true),  
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
                  
            ]);
    }
}
