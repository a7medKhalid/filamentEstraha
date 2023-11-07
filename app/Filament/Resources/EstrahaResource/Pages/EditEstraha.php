<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Resources\EstrahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstraha extends EditRecord
{
    protected static string $resource = EstrahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
