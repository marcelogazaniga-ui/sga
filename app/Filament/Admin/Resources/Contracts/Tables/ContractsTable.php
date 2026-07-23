<?php

namespace App\Filament\Admin\Resources\Contracts\Tables;

use Filament\Actions\ViewAction;
use App\Enums\ContractStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContractsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([


                TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('property.title')
                    ->label('Imóvel')
                    ->searchable()
                    ->sortable(),


                TextColumn::make('property.city')
                    ->label('Cidade')
                    ->sortable(),


                TextColumn::make('rent_value')
                    ->label('Aluguel')
                    ->money('BRL')
                    ->sortable(),


                TextColumn::make('start_date')
                    ->label('Início')
                    ->date('d/m/Y')
                    ->sortable(),


                TextColumn::make('end_date')
                    ->label('Fim')
                    ->date('d/m/Y')
                    ->sortable(),


                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn ($state) =>
                            $state instanceof ContractStatus
                                ? $state->label()
                                : $state
                    ),


            ])


            ->filters([

                SelectFilter::make('status')
                    ->label('Status')
                    ->options(
                        ContractStatus::options()
                    ),

            ])


            ->recordActions([
                  ViewAction::make(),
                  EditAction::make(),
            ])


            ->toolbarActions([
                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),
            ]);
    }
}
