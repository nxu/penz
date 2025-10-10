<?php

namespace App\Filament\Resources\TransactionCategories\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionCategoryForm
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
            ]);
    }
}
