<?php

namespace App\Filament\Forms;

use App\Models\Estraha;
use Filament\Forms;

class EstrahaForm
{

    public function getForm(): array {

        return [
            Forms\Components\TextInput::make('name')
                ->autofocus()
                ->required()
                ->maxLength(255)
                ->unique(Estraha::class, 'name', ignoreRecord: true),

            Forms\Components\TextInput::make('description')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->preload()
                ->searchable()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->autofocus()
                        ->required()
                        ->maxLength(255),
                ])
                ->required(),
        ];
    }

}
