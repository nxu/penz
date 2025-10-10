<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('date')
                    ->label('Dátum')
                    ->date('Y. F j.'),

                TextEntry::make('amount')
                    ->label('Összeg')
                    ->money('HUF', decimalPlaces: 0),

                TextEntry::make('comments')
                    ->label('Megjegyzés')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('category.title')
                    ->label('Kategória')
                    ->placeholder('-'),

                TextEntry::make('subcategory.title')
                    ->label('Alkategória')
                    ->placeholder('-'),
            ]);
    }
}
