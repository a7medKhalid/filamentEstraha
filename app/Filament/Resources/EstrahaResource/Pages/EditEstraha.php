<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Forms\EstrahaForm;
use App\Filament\Forms\PriceForm;
use App\Filament\Resources\EstrahaResource;
use Filament\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
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

    public function form(Form $form): Form
    {
        return $form
            ->schema(fn(EstrahaForm $form) => $form->getForm());
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getRelationManagers(): array
    {
        return [
            EstrahaResource\RelationManagers\PricesRelationManager::class
        ];
    }
}
