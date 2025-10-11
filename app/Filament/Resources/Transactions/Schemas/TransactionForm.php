<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\TransactionCategory;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('Dátum')
                    ->default(fn () => today())
                    ->required(),

                TextInput::make('amount')
                    ->label('Összeg')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                Select::make('transaction_category_id')
                    ->label('Kategória')
                    ->relationship(
                        'category',
                        'title',
                        fn (Builder $query) => $query->where('transaction_categories.user_id', Filament::auth()->id())
                    )
                    ->live()
                    ->required(),

                Select::make('transaction_subcategory_id')
                    ->label('Alkategória')
                    ->visible(function (Get $get) {
                        return TransactionCategory::find($get('transaction_category_id'))?->subcategories()->exists();
                    })
                    ->required()
                    ->relationship(
                        'subcategory',
                        'title',
                        function (Builder $query, Get $get) {
                            return $query->where('transaction_subcategories.user_id', Filament::auth()->id())
                                ->where('transaction_category_id', $get('transaction_category_id'));
                        }
                    )
                    ->required(),

                Textarea::make('comments')
                    ->label('Megjegyzés')
                    ->columnSpanFull(),
            ]);
    }
}
