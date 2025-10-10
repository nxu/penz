<?php

namespace App\Filament\Resources\TransactionSubcategories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionSubcategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Megnevezés')
                    ->required(),

                ColorPicker::make('color')
                    ->label('Szín'),

                Select::make('transaction_category_id')
                    ->relationship('parentCategory', 'title')
                    ->required(),
            ]);
    }
}
