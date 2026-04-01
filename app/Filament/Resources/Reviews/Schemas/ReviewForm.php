<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('rating')
                    ->options([
                        5 => '★★★★★ (5 stars)',
                        4 => '★★★★☆ (4 stars)',
                        3 => '★★★☆☆ (3 stars)',
                        2 => '★★☆☆☆ (2 stars)',
                        1 => '★☆☆☆☆ (1 star)',
                    ])
                    ->required()
                    ->default(5),
                TextInput::make('title')
                    ->maxLength(255)
                    ->placeholder('Review title'), 
                RichEditor::make('comment')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                    ]),  
                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->directory('reviews')
                    ->imageResizeMode('cover')
                    ->maxSize(2048)
                    ->columnSpanFull(),
                Toggle::make('is_verified_purchase')
                    ->label('Verified Purchase')
                    ->default(true)
                    ->helperText('Customer actually purchased this product'),
                Toggle::make('is_approved')
                    ->label('Approved')
                    ->default(true),    
                Toggle::make('is_featured')
                    ->label('Featured Review')
                    ->helperText('Show this review prominently'),
                Textarea::make('admin_reply')
                    ->rows(3)
                    ->placeholder('Reply to this review...')
                    ->columnSpanFull(),
                DateTimePicker::make('replied_at')
                    ->label('Reply Date'),         
            ]);
    }
}
