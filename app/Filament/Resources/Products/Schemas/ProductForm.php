<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->name ?? 'Unnamed Category #' . ($record->id ?? 'Unknown');
                    }),

                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('brand')
                    ->maxLength(255),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01),

                TextInput::make('old_price')
                    ->numeric()
                    ->prefix('₹')
                    ->step(0.01),

                Select::make('stock')
                    ->options([
                        'available' => 'Available',
                        'low' => 'Low Stock',
                        'out_of_stock' => 'Out of Stock',
                    ])
                    ->default('available')
                    ->required(),

                FileUpload::make('image')
    ->image()
    ->directory('products')  // This will save to storage/app/public/products
    ->visibility('public')    // Make sure it's public
    ->imageResizeMode('cover')
    ->imageCropAspectRatio('1:1')
    ->maxSize(2048)
    ->preserveFilenames(false)  // Generate unique names
    ->imageResizeTargetWidth('500')
    ->imageResizeTargetHeight('500'),

                CheckboxList::make('badges')
                    ->options([
                        'New' => 'New',
                        'Sale' => 'Sale',
                        'Limited' => 'Limited Edition',
                        'Exclusive' => 'Exclusive',
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Toggle::make('is_best_seller')->label('Best Seller'),
                Toggle::make('is_trending')->label('Trending'),
                Toggle::make('is_new')->label('New Arrival'),
                Toggle::make('is_active')->label('Active')->default(true),
            ]);
    }
}