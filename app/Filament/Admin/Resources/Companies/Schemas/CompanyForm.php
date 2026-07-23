<?php

namespace App\Filament\Admin\Resources\Companies\Schemas;

use App\Support\Forms\CepInput;
use App\Support\Forms\DocumentInput;
use App\Support\Forms\PhoneInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados da Empresa')
                    ->schema([

                        TextInput::make('name')
                            ->label('Razão Social')
                            ->required(),

                        TextInput::make('trade_name')
                            ->label('Nome Fantasia'),

                        DocumentInput::make('document'),

                    ])
                    ->columns(2),


                Section::make('Contato')
                    ->schema([

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email(),

                        PhoneInput::make('phone'),

                    ])
                    ->columns(2),


                Section::make('Endereço')
                    ->schema([

                        CepInput::make('zip_code'),

                        TextInput::make('address')
                            ->label('Endereço'),

                        TextInput::make('number')
                            ->label('Número'),

                        TextInput::make('district')
                            ->label('Bairro'),

                        TextInput::make('city')
                            ->label('Cidade'),

                        TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2),

                    ])
                    ->columns(2),


                Section::make('Logo')
                    ->schema([

                        FileUpload::make('logo')
                            ->image()
                            ->directory('companies'),

                    ]),

            ]);
    }
}
