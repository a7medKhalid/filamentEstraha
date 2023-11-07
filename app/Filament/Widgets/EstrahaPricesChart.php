<?php

namespace App\Filament\Widgets;

use App\Models\Price;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class EstrahaPricesChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = Trend::model(Price::class)
            ->dateColumn('start_date')
            ->between(
                start: now()->subYear(),
                end: now()
            )
            ->perMonth()
            ->average('price');



        return [
            'labels' => $data->pluck('date'),
            'datasets' => [
                [
                    'label' => 'Average Price',
                    'data' => $data->pluck('aggregate'),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
