<?php

namespace App\Filament\Admin\Resources\People\Schemas;

use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\TextInput\Mask;
use App\Enums\PersonKind;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class PersonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Dados Gerais')
                    ->schema([

                        Select::make('roles')
                            ->label('Papéis')
                            ->multiple()
                            ->options([
                                'owner' => 'Proprietário',
                                'landlord' => 'Locador',
                                'tenant' => 'Locatário',
                                'guarantor' => 'Fiador',
                                'provider' => 'Prestador',
                                'employee' => 'Funcionário',
                            ])
                            ->preload(),

                        Select::make('person_kind')
                            ->label('Classificação')
                            ->options(PersonKind::options())
                            ->default('individual')
                            ->live()
                            ->required(),

                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('trade_name')
    ->label('Nome Fantasia')
    ->visible(fn ($get) =>
        $get('person_kind') === 'company'
    )
    ->required(fn ($get) =>
        $get('person_kind') === 'company'
    ),
                        TextInput::make('document')
    ->label(fn ($get) =>
        $get('person_kind') === 'company'
            ? 'CNPJ'
            : 'CPF'
    )
    ->mask(fn ($get) =>
        $get('person_kind') === 'company'
            ? '99.999.999/9999-99'
            : '999.999.999-99'
    )
    ->stripCharacters('.-/')
    ->maxLength(fn ($get) =>
        $get('person_kind') === 'company'
            ? 18
            : 14
    ),
                        DatePicker::make('birth_date')
                            ->label('Data Nascimento'),

                        TextInput::make('email')
                            ->email()
                            ->label('E-mail'),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->mask('(99) 99999-9999'),

                        TextInput::make('mobile')
                            ->label('Celular')
                            ->mask('(99) 99999-9999'),

                    ])
                    ->columns(2),


                Section::make('Endereço')
                    ->schema([

                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->mask('99999-999')
    ->live()
    ->afterStateUpdated(function ($state, callable $set) {

        if (! $state) {
            return;
        }

        $cep = preg_replace('/[^0-9]/', '', $state);

        if (strlen($cep) !== 8) {
            return;
        }

        try {

            $response = Http::get(
                "https://viacep.com.br/ws/{$cep}/json/"
            );

            if ($response->successful()) {

                $data = $response->json();

                if (!isset($data['erro'])) {

                    $set('address', $data['logradouro'] ?? '');
                    $set('district', $data['bairro'] ?? '');
                    $set('city', $data['localidade'] ?? '');
                    $set('state', $data['uf'] ?? '');

                }

            }

        } catch (\Exception $e) {

            // ignora erro de conexão

        }

    }),

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
                                'cpf' => 'CPF',
                                'cnpj' => 'CNPJ',
                                'email' => 'E-mail',
                                'phone' => 'Telefone',
                                'random' => 'Aleatória',
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
                        1 => 'Ativo',
                        0 => 'Inativo',
                    ])
                    ->default(1)
                    ->required(),

            ]);
    }
}
