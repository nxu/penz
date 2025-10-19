<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlyTransactionsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        $categories = $user->categories()->pluck('title', 'id');

        $total = $user->transactions()
            ->whereDate('date', '>=', today()->startOfMonth())
            ->whereDate('date', '<=', today()->endOfMonth())
            ->sum('amount');

        $total = number_format($total, thousands_separator: ' ').' Ft';

        return $user->transactions()
            ->whereDate('date', '>=', today()->startOfMonth())
            ->whereDate('date', '<=', today()->endOfMonth())
            ->selectRaw('SUM(amount) as sum')
            ->selectRaw('transaction_category_id')
            ->groupBy('transaction_category_id')
            ->orderByDesc('sum')
            ->get()
            ->map(function ($t) use ($categories) {
                $sum = number_format($t->sum, thousands_separator: ' ').' Ft';

                return Stat::make('Havi '.$categories->get($t->transaction_category_id), $sum);
            })
            ->prepend(Stat::make('Havi összes', $total))
            ->values()
            ->all();
    }
}
