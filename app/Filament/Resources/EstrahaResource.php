<?php

namespace App\Filament\Resources;

use App\Filament\Forms\EstrahaForm;
use App\Filament\Forms\PriceForm;
use App\Filament\Resources\EstrahaResource\Pages;
use App\Filament\Resources\EstrahaResource\RelationManagers;
use App\Filament\Resources\EstrahaResource\Widgets\EstrahaOverview;
use App\Models\Estraha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EstrahaResource extends Resource
{
    protected static ?string $model = Estraha::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Estraha Information')
                ->schema(
                   fn(EstrahaForm $form) => $form->getForm()
                ),

                Forms\Components\Section::make('Prices')
                    ->schema([
                        Forms\Components\Repeater::make('prices')
                            ->schema(
                                fn(PriceForm $form) => $form->getForm()
                            )
                            ->disabledOn('edit'),
                    ])->hiddenOn('edit')
                ->hiddenOn('view')



            ])

            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->placeholder(__('Select Category'))
                    ->options(
                        fn (Builder $query) => $query->pluck('name', 'id')
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn (Estraha $estraha) => route('filament.admin.resources.estrahas.view', $estraha))
            ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PricesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstrahas::route('/'),
            'create' => Pages\CreateEstraha::route('/create'),
            'edit' => Pages\EditEstraha::route('/{record}/edit'),
            'view' => Pages\ViewEstraha::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            EstrahaOverview::class
        ];
    }
}
