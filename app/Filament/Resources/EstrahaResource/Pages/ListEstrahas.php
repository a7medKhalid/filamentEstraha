<?php

namespace App\Filament\Resources\EstrahaResource\Pages;

use App\Filament\Resources\EstrahaResource;
use App\Models\Estraha;
use Filament;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;


class ListEstrahas extends ListRecords
{
    protected static string $resource = EstrahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Filament\Actions\CreateAction::make(),
            Filament\Actions\Action::make('Mail Owner')
            ->form(
                [
                    Filament\Forms\Components\TextInput::make('subject')
                        ->autofocus()
                        ->required()
                        ->maxLength(255),

                    Filament\Forms\Components\Textarea::make('body')
                        ->autofocus()
                        ->required()
                        ->maxLength(255),

                    Filament\Forms\Components\Select::make('estraha_id')
                    ->options(
                        Estraha::all()->pluck('name', 'id')
                    )

                ]
            )
            ->action(
                fn ($data) => $this->sendMail($data)
            ),
        ];
    }

    private function sendMail($data){
        //sen mail message
        dd('mail sent');
    }
}
