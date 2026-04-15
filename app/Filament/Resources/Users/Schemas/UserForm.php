<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;
class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter full name'),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('example@gmail.com'),

                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->confirmed() // 👈 adds password_confirmation
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->maxLength(255)
                    ->label('Password'),

                TextInput::make('password_confirmation')
                    ->password()
                    ->label('Confirm Password')
                    ->visible(fn ($context) => $context === 'create'),
                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),    

                FileUpload::make('avatar')
                    ->avatar()
                    ->image()
                    ->directory('avatars')
                    ->circleCropper()
                    ->imageEditor() // 👈 better UX
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