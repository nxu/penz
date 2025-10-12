<?php

namespace App\Filament\Resources\TransactionSubcategories\Schemas;

use App\Models\TransactionCategory;
use Filament\Facades\Filament;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

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
                    ->relationship('parentCategory', 'title', modifyQueryUsing: function (Builder $builder) {
                        return $builder
                            ->setModel(new TransactionCategory) // ??? Pretty sure it's a Filament bug, it has to be specified
                            ->where('user_id', Filament::auth()->id())
                            ->orderBy('order_column');
                    })
                    ->required(),
            ]);
    }
}
