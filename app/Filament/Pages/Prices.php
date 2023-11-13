<?php

namespace App\Filament\Pages;

use App\Models\Price;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class Prices extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.prices';

    public function table(Table $table): Table
    {
        return $table
            ->query(Price::query()->with('estraha'))
            ->columns([
                TextColumn::make('price')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('estraha.name')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('status')
                ->default(fn($record) => $this->isActive($record) ? 'green' : 'red')
                ->tooltip(fn($record) => $this->isActive($record) ? 'Active' : 'Inactive')

            ])
            ->filters([
                Filter::make('Date')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->firstDayOfWeek(1)
                            ->format('YYYY-MM-DD')
                            ->default(now()->startOfMonth()),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->firstDayOfWeek(1)
                            ->format('YYYY-MM-DD')
                            ->default(now()->endOfMonth()),
                        ]
                    )
                    ->query(function (Builder $query, array $data){
                        $query->whereBetween('start_date', [$data['start_date'], $data['end_date']]);
                    }),
            ])
            ->defaultGroup('start_date');
    }

    private function isActive($record)
    {
        return now()->between($record->start_date, $record->end_date);
    }
}
