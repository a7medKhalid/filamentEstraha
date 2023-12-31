<?php

namespace App\Filament\Resources\EstrahaResource\RelationManagers;

use App\Filament\Forms\PriceForm;
use App\Models\Price;
use App\Repositories\PriceRepository;
use App\Services\Mailers\NiceMailerService;
use App\Services\PriceService;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricesRelationManager extends RelationManager
{
    protected static string $relationship = 'prices';

    protected PriceService $priceService;

    public function __construct()
    {
        $this->priceService = new PriceService(new PriceRepository(new Price()), new NiceMailerService());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(
                fn(PriceForm $form) => $form->getForm()
            );
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('price')
            ->columns([
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('discount')
                ->default('0'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('Reset')
                ->requiresConfirmation()
                ->action(
                    function(Table $table) {
                        $table->getQuery()->delete();
                        Notification::make()
                            ->title('Prices Reset')
                            ->body('All prices have been reset')
                            ->success()
                            ->send();
                    }
                )
                ->color('danger')
                ->hidden('view')
            ])
            ->actions([
                Tables\Actions\Action::make('Discount')
                    ->icon('heroicon-o-tag')
                ->form(

                        fn(Model $record) => [Forms\Components\TextInput::make('discount')
                            ->prefix('SAR')
                            ->autofocus()
                            ->numeric()
                            ->minValue(0)
                            ->maxValue($record->price )
                            ->required()]

                )
                ->action(
                    fn(Model $record, array $data) => $this->priceService->addDiscount($record->id, $data['discount'])
                )                ->hidden('view')

                ,
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
