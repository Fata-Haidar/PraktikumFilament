<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;   
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Tabs::make('Product Tabs')
    ->tabs([
        Tab::make('Product Details')
         ->icon('heroicon-o-cube')
            ->schema([
                TextEntry::make('name')
                    ->label('Product Name')
                    ->weight('bold')
                    ->color('primary'),

                TextEntry::make('id')
                    ->label('Product ID'),

                TextEntry::make('sku')
                    ->label('Product SKU')
                    ->badge()
                    ->color('warning'),

                TextEntry::make('description')
                    ->label('Product Description'),

                TextEntry::make('created_at')
                    ->label('Product Creation Date')
                    ->date('d M Y')
                    ->color('info'),
            ]),

        Tab::make('Pricing & Stock')
            ->icon('heroicon-o-currency-dollar')
            ->schema([
                TextEntry::make('price')
                    ->label('Product Price')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->icon('heroicon-o-currency-dollar'),

                TextEntry::make('stock')
                    ->label('Product Stock')
                    ->badge()
                   
                    ->icon('heroicon-o-cube'),
            ]),

        Tab::make('Media & Status')
            ->icon('heroicon-o-photo')
            ->schema([
                ImageEntry::make('image')
                    ->label('Product Image')
                    ->disk('public'),

                TextEntry::make('price')
                    ->label('Product Price')
                    ->icon('heroicon-o-currency-dollar'),

                TextEntry::make('stock')
                    ->label('Product Stock'),

                IconEntry::make('is_active')
                    ->label('Is Active?')
                    ->boolean(),

                IconEntry::make('is_featured')
                    ->label('Is Featured?')
                    ->boolean(),
            ]),
    ])
    ->columnSpanFull()
    
            ]);
    }
    
}
