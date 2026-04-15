<?php

namespace App\Filament\Resources\Permissions;

use App\Filament\Resources\Permissions\Pages\CreatePermission;
use App\Filament\Resources\Permissions\Pages\EditPermission;
use App\Filament\Resources\Permissions\Pages\ListPermissions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use UnitEnum;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-key';
    protected static string|UnitEnum|null $navigationGroup = 'User Management';

    

    

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPermissions::route('/'),
            'create' => CreatePermission::route('/create'),
            'edit' => EditPermission::route('/{record}/edit'),
        ];
    }
}