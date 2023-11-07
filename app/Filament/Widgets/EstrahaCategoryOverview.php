<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EstrahaCategoryOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $stats = [];

        foreach (Category::all() as $Category){
            $stats[] = Stat::make($Category->name, $Category->estrahas()->count());
        }
        return $stats;
    }
}
