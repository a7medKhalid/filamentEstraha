<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Resources\EstrahaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

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
