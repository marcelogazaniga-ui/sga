<?php

namespace App\Filament\Admin\Resources\People\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Section;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados Gerais')
                    ->schema([

                        Select::make('person_type')
                            ->label('Tipo de Pessoa')
                            ->options([
                                'owner' => 'Proprietário',
                                'tenant' => 'Inquilino',
                                'guarantor' => 'Fiador',
                                'supplier' => 'Fornecedor',
                                'employee' => 'Funcionário',
                            ])
                            ->required(),

                        Select::make('person_kind')
                            ->label('Classificação')
                            ->options([
                                'individual' => 'Pessoa Física',
                                'company' => 'Pessoa Jurídica',
                            ])
                            ->default('individual')
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('trade_name')
                            ->label('Nome Fantasia')
                            ->visible(fn ($get) =>
                                $get('person_kind') === 'company'
                            ),

                        TextInput::make('document')
                            ->label('CPF / CNPJ')
                            ->maxLength(20),

                        DatePicker::make('birth_date')
                            ->label('Data Nascimento'),

                        TextInput::make('email')
                            ->email()
                            ->label('E-mail'),

                        TextInput::make('phone')
                            ->label('Telefone'),

                        TextInput::make('mobile')
                            ->label('Celular'),

                    ])
                    ->columns(2),



                Section::make('Endereço')
                    ->schema([

                        TextInput::make('zip_code')
                            ->label('CEP'),

                        TextInput::make('address')
                            ->label('Endereço'),

                        TextInput::make('number')
                            ->label('Número'),

                        TextInput::make('complement')
                            ->label('Complemento'),

                        TextInput::make('district')
                            ->label('Bairro'),

                        TextInput::make('city')
                            ->label('Cidade'),

                        TextInput::make('state')
                            ->label('UF')
                            ->maxLength(2),

                    ])
                    ->columns(2),



                Section::make('Financeiro')
                    ->schema([

                        TextInput::make('pix_key')
                            ->label('Chave PIX'),

                        Select::make('pix_type')
                            ->label('Tipo PIX')
                            ->options([
                                'cpf'=>'CPF',
                                'cnpj'=>'CNPJ',
                                'email'=>'E-mail',
                                'phone'=>'Telefone',
                                'random'=>'Aleatória',
                            ]),

                        TextInput::make('bank')
                            ->label('Banco'),

                        TextInput::make('agency')
                            ->label('Agência'),

                        TextInput::make('account')
                            ->label('Conta'),

                    ])
                    ->columns(2),



                Section::make('Observações')
                    ->schema([

                        Textarea::make('notes')
                            ->label('Observações')
                            ->rows(4),

                    ]),



                Select::make('active')
                    ->label('Status')
                    ->options([
                        1=>'Ativo',
                        0=>'Inativo',
                    ])
                    ->default(1)
                    ->required(),

            ]);
    }
}
