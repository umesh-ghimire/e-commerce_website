<?php

namespace App\Filament\Resources\SocialMediaLinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SocialMediaLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('platform')
                    ->required()
                    ->options([
                        'Facebook' => 'Facebook',
                        'Instagram' => 'Instagram',
                        'Twitter' => 'Twitter',
                        'YouTube' => 'YouTube',
                        'LinkedIn' => 'LinkedIn',
                        'Pinterest' => 'Pinterest',
                        'TikTok' => 'TikTok',
                        'WhatsApp' => 'WhatsApp',
                    ])
                    ->searchable(),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255)
                    ->url(),
                TextInput::make('icon_class')
                    ->maxLength(100)
                    ->helperText('FontAwesome icon class (e.g., fab fa-facebook-f)')
                    ->placeholder('fab fa-facebook-f'),
                TextInput::make('color')
                    ->type('color')
                    ->helperText('Brand color for the icon background')
                    ->default('#1877f2'),
                Toggle::make('is_active')
                    ->default(true),    
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),    
            ]);
    }
}
