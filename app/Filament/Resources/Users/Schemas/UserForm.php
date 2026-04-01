<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => FacadesHash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                FileUpload::make('avatar')
                    ->avatar()
                    ->image()
                    ->directory('avatars')
                    ->circleCropper()
                    ->maxSize(1024),
                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At'),
                TextInput::make('google_id')
                    ->default(null)
                    ->visibleOn('edit'),
                TextInput::make('facebook_id')
                    ->default(null)
                    ->visibleOn('edit'),
            ]);
    }
}
