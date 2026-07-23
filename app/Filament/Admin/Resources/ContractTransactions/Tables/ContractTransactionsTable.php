<?php

namespace App\Filament\Admin\Resources\ContractTransactions\Tables;

use Filament\Actions\Action;
use App\Enums\TransactionStatus;
use Filament\Notifications\Notification;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ContractTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('contract.codigo')
                    ->label('Contrato')
                    ->searchable(),


                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(
                        fn ($state) => $state?->label()
                    ),


                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),


                TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),


                TextColumn::make('value')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),


                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn ($state) => $state?->label()
                    ),

            ])

            ->filters([

            ])

->recordActions([

    Action::make('receive')
        ->label('Receber')
        ->icon('heroicon-o-banknotes')
        ->color('success')

        ->visible(
            fn ($record) =>
                $record->status !== TransactionStatus::PAID
        )

        ->requiresConfirmation()

        ->action(function ($record) {

            $record->markAsPaid();

            Notification::make()
                ->title('Pagamento confirmado')
                ->success()
                ->send();

        }),

    EditAction::make(),

])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
