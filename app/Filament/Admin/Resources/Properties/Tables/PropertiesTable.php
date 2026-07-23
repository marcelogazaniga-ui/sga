<?php

namespace App\Filament\Admin\Resources\Properties\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use App\Models\Company;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([


                TextColumn::make('company.name')

                    ->label('Empresa')

                    ->searchable()

                    ->sortable(),



                TextColumn::make('codigo')

                    ->label('Código')

                    ->searchable()

                    ->sortable(),



                TextColumn::make('title')

                    ->label('Imóvel')

                    ->searchable()

                    ->sortable(),



                TextColumn::make('type_label')

                    ->label('Tipo')

                    ->sortable(),



                TextColumn::make('city')

                    ->label('Cidade')

                    ->searchable()

                    ->sortable(),



                TextColumn::make('rent_value')

                    ->label('Valor aluguel')

                    ->money('BRL')

                    ->sortable(),



                TextColumn::make('status_label')

                    ->label('Situação')

                    ->badge()

                    ->color(fn ($state) => match ($state) {


                        'Disponível' =>
                            'success',


                        'Alugado' =>
                            'info',


                        'Reservado' =>
                            'warning',


                        'Manutenção' =>
                            'orange',


                        'Inativo' =>
                            'danger',


                        default =>
                            'gray',

                    }),



                TextColumn::make('created_at')

                    ->label('Cadastro')

                    ->dateTime('d/m/Y')

                    ->sortable(),


            ])



            ->filters([


                SelectFilter::make('company_id')

                    ->label('Empresa')

                    ->options(

                        Company::query()

                            ->pluck('name', 'id')

                            ->toArray()

                    ),



                SelectFilter::make('type')

                    ->label('Tipo')

                    ->options([


                        'house' =>
                            'Casa',


                        'apartment' =>
                            'Apartamento',


                        'commercial' =>
                            'Sala Comercial',


                        'land' =>
                            'Terreno',

                    ]),



                SelectFilter::make('status')

                    ->label('Situação')

                    ->options([


                        'available' =>
                            'Disponível',


                        'rented' =>
                            'Alugado',


                        'reserved' =>
                            'Reservado',


                        'maintenance' =>
                            'Manutenção',


                        'inactive' =>
                            'Inativo',


                    ]),


            ])



            ->actions([

                EditAction::make(),

            ])



            ->bulkActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),

            ]);

    }
}
