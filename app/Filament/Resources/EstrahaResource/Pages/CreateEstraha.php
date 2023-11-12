<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Resources\EstrahaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEstraha extends CreateRecord
{
    protected static string $resource = EstrahaResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $prices = $data['prices'];

        //remove prices from data
        unset($data['prices']);

        $estraha = parent::handleRecordCreation($data);

        //add prices to estraha
        $estraha->prices()->createMany($prices);


        return $estraha;
    }
}
