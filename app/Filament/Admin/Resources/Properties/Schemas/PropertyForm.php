<?php

namespace App\Filament\Admin\Resources\Properties\Schemas;

use App\Enums\PropertyPersonRole;
use App\Forms\Components\MoneyInput;
use App\Models\Person;
use App\Models\Company;
use App\Support\FormMasks;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Section::make('Dados do Imóvel')

                    ->schema([


                        Select::make('company_id')

                            ->label('Empresa')

                            ->relationship(
                                'company',
                                'name'
                            )

                            ->searchable()

                            ->preload()

                            ->required(),



                        TextInput::make('codigo')

                            ->label('Código')

                            ->disabled()

                            ->dehydrated(false)

                            ->hiddenOn('create'),



                        TextInput::make('title')

                            ->label('Título')

                            ->required()

                            ->maxLength(255),



                        Select::make('type')

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

                            ])

                            ->required(),


                    ])

                    ->columns(2),



                Section::make('Localização')

                    ->schema([


                        FormMasks::cep('zip_code')

                            ->label('CEP'),



                        TextInput::make('address')

                            ->label('Endereço')

                            ->required(),



                        TextInput::make('number')

                            ->label('Número'),



                        TextInput::make('district')

                            ->label('Bairro'),



                        TextInput::make('city')

                            ->label('Cidade')

                            ->required(),



                        TextInput::make('state')

                            ->label('Estado')

                            ->default('SC')

                            ->maxLength(2),


                    ])

                    ->columns(2),



                Section::make('Características')

                    ->schema([


                        FormMasks::decimal('area')

                            ->label('Área (m²)'),



                        FormMasks::integer('bedrooms')

                            ->label('Quartos'),



                        FormMasks::integer('bathrooms')

                            ->label('Banheiros'),



                        FormMasks::integer('parking_spaces')

                            ->label('Vagas'),



                        MoneyInput::make('rent_value')

                            ->label('Valor aluguel'),


                    ])

                    ->columns(2),



                Section::make('Participantes do Imóvel')

                    ->description(
                        'Proprietários, administradores, corretores e demais envolvidos'
                    )

                    ->schema([


                        Repeater::make('propertyPeople')

                            ->label('')

                            ->relationship('propertyPeople')

                            ->schema([


                                Select::make('person_id')

                                    ->label('Pessoa')

                                    ->options(

                                        Person::query()

                                            ->where('active', true)

                                            ->pluck('name', 'id')

                                            ->toArray()

                                    )

                                    ->searchable()

                                    ->preload()

                                    ->required(),



                                Select::make('role')

                                    ->label('Papel')

                                    ->options(

                                        PropertyPersonRole::options()

                                    )

                                    ->required(),


                            ])

                            ->columns(2)

                            ->addActionLabel(
                                'Adicionar Participante'
                            ),


                    ]),



                Section::make('Status')

                    ->schema([


                        Select::make('status')

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


                            ])

                            ->default('available')

                            ->required(),


                    ]),



                Section::make('Observações')

                    ->schema([


                        Textarea::make('notes')

                            ->label('Observações')

                            ->rows(4)

                            ->columnSpanFull(),


                    ]),


            ]);
    }
}
