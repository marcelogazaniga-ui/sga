<?php

namespace App\Filament\Admin\Resources\People\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class PeopleTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('person_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'owner' => 'Proprietário',
                        'tenant' => 'Inquilino',
                        'guarantor' => 'Fiador',
                        'supplier' => 'Fornecedor',
                        'employee' => 'Funcionário',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('document')
                    ->label('CPF/CNPJ')
                    ->searchable(),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Telefone'),

                TextColumn::make('active')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(
                        fn ($state) => $state ? 'Ativo' : 'Inativo'
                    )
                    ->color(
                        fn ($state) => $state ? 'success' : 'danger'
                    ),

                TextColumn::make('created_at')
                    ->label('Cadastro')
                    ->dateTime('d/m/Y'),

            ])

            ->filters([

                SelectFilter::make('person_type')
                    ->label('Tipo')
                    ->options([
                        'owner' => 'Proprietário',
                        'tenant' => 'Inquilino',
                        'guarantor' => 'Fiador',
                        'supplier' => 'Fornecedor',
                        'employee' => 'Funcionário',
                    ]),

                SelectFilter::make('active')
                    ->label('Status')
                    ->options([
                        1 => 'Ativo',
                        0 => 'Inativo',
                    ]),

            ])

            ->actions([

                EditAction::make(),

                DeleteAction::make(),

            ]);
    }
}
