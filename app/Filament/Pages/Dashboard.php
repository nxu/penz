<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\EntryPageLink;
use App\Filament\Widgets\MonthlyTransactionsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            MonthlyTransactionsWidget::class,
            EntryPageLink::class,
        ];
    }
}
