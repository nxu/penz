<?php

namespace App\Filament\Resources\TransactionSubcategories\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionSubcategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Megnevezés')
                    ->searchable(),

                TextColumn::make('color')
                    ->label('Szín')
                    ->searchable(),

                TextColumn::make('parentCategory.title')
                    ->label('Főkategória')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->reorderable('order_column');
    }
}
