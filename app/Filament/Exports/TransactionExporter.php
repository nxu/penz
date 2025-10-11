<?php

namespace App\Filament\Exports;

use App\Models\Transaction;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class TransactionExporter extends Exporter
{
    protected static ?string $model = Transaction::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('ID'),
            ExportColumn::make('date')->label('Dátum'),
            ExportColumn::make('amount')->label('Összeg'),
            ExportColumn::make('transaction_category_id')->label('Kategória ID'),
            ExportColumn::make('category.title')->label('Kategória megnevezés'),
            ExportColumn::make('transaction_subcategory_id')->label('Alkategória ID'),
            ExportColumn::make('subcategory.title')->label('Alkategória megnevezés'),
            ExportColumn::make('comments')->label('Megjegyzés'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Az export kész, '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' sort exportáltunk.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
