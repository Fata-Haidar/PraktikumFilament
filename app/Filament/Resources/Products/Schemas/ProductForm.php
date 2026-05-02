<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon(Heroicon::OutlinedCube)
                        ->description('Isi Informasi Produk')
                        ->schema([
                            Group::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                        ]),
                Step::make('Product Price and Stock')
                    ->icon(Heroicon::OutlinedCurrencyDollar)
                    ->description('Isi Harga Produk')
                    ->schema([
                        Group::make([
                            TextInput::make('price')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                            TextInput::make('stock')
                            ->required(),
                        ])->columns(2),
                        MarkdownEditor::make('description')
                        ]),
                Step::make('Media & Status')
                    ->icon(Heroicon::OutlinedPhoto)     
                    ->description('Upload gambar dan atur status') 
                    ->schema([ 
                    FileUpload::make('image') 
                        ->disk('public') 
                        ->directory('products'), 
                    Checkbox::make('is_active'), 
                    Checkbox::make('is_featured'), 
                    ]), 
                ])
                ->skippable()
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                ),
            ]);
    }
}
