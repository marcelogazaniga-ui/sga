<?php

namespace App\Filament\Admin\Resources\Properties\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([


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



                TextColumn::make('property_people_count')

                    ->label('Participantes')

                    ->counts('propertyPeople'),



                TextColumn::make('status_label')

                    ->label('Situação')

                    ->badge()

                    ->color(fn ($state) => match ($state) {


                        'Disponível' =>
                            'success',


                        'Indisponível' =>
                            'danger',


                        default =>
                            'gray',


                    }),



                IconColumn::make('active')

                    ->label('Ativo')

                    ->boolean(),



                TextColumn::make('created_at')

                    ->label('Cadastro')

                    ->dateTime('d/m/Y')

                    ->sortable(),



            ])



            ->filters([


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



                SelectFilter::make('active')

                    ->label('Situação')

                    ->options([

                        1 =>
                            'Disponível',

                        0 =>
                            'Indisponível',

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
