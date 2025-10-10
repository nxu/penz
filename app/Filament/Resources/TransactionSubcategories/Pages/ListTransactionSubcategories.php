<?php

namespace App\Filament\Resources\TransactionSubcategories\Pages;

use App\Filament\Resources\TransactionSubcategories\TransactionSubcategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransactionSubcategories extends ListRecords
{
    protected static string $resource = TransactionSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
