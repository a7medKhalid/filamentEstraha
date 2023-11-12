<?php

namespace App\Filament\Resources\EstrahaResource\Widgets;

use App\Models\Estraha;
use App\Models\Price;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EstrahaOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Estrahas', Estraha::count())
            ->icon('heroicon-o-home-modern'),
            Stat::make('Total Prices', Price::count())
            ->icon('heroicon-o-currency-dollar'),

        ];
    }
}
