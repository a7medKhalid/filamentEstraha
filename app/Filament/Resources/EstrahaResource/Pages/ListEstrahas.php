<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Resources\EstrahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstrahas extends ListRecords
{
    protected static string $resource = EstrahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
