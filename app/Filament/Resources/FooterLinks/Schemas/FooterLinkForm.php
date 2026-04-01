<?php

namespace App\Filament\Resources\FooterLinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FooterLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Select::make('section')
                    ->required()
                    ->options([
                        'department' => 'Department',
                        'about' => 'About Us',
                        'services' => 'Services',
                        'bottom_links' => 'Bottom Bar Links',
                        'legal' => 'Legal Links',
                    ])
                    ->searchable(),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255)
                    ->url(),
                TextInput::make('icon')
                    ->maxLength(50)
                    ->helperText('Enter emoji or icon class (e.g., 💼, fab fa-facebook)')
                    ->placeholder('💼'),
                Toggle::make('is_active')
                    ->default(true),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),    
            ]);
    }
}
