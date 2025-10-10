<?php

namespace App\Filament\Resources\TransactionSubcategories\Pages;

use App\Filament\Resources\TransactionSubcategories\TransactionSubcategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransactionSubcategory extends EditRecord
{
    protected static string $resource = TransactionSubcategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
