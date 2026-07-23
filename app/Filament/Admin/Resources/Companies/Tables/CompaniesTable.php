<?php

namespace App\Filament\Admin\Resources\Companies\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label('Empresa')
                    ->searchable(),

                TextColumn::make('trade_name')
                    ->label('Nome Fantasia')
                    ->searchable(),

                TextColumn::make('document')
                    ->label('CNPJ'),

                TextColumn::make('email')
                    ->label('E-mail'),

                TextColumn::make('city')
                    ->label('Cidade'),

                TextColumn::make('state')
                    ->label('UF'),

            ])

            ->filters([
                //
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
