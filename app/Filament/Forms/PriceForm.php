<?php

namespace App\Filament\Forms;

use Filament\Forms;

class PriceForm
{

    public function getForm(): array {

        return [
            Forms\Components\TextInput::make('price')
                ->prefix('SAR')
                ->autofocus()
                ->numeric()
                ->minValue(0)
                ->required(),

            Forms\Components\DatePicker::make('start_date')
                ->minDate(now())
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->required(),
        ];
    }

}
