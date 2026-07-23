<?php

namespace App\Filament\Admin\Resources\Contracts\Schemas;

use App\Enums\ContractStatus;
use App\Forms\Components\MoneyInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Section::make('Dados do Contrato')

                    ->schema([


                        Select::make('property_id')

                            ->label('Imóvel')

                            ->relationship(
                                'property',
                                'title'
                            )

                            ->searchable()

                            ->preload()

                            ->required(),



                        Select::make('status')

                            ->label('Status')

                            ->options(
                                ContractStatus::options()
                            )

                            ->default('active')

                            ->required(),



                        DatePicker::make('start_date')

                            ->label('Início')

                            ->required(),



                        DatePicker::make('end_date')

                            ->label('Fim'),



                    ])

                    ->columns(2),





                Section::make('Valores')

                    ->schema([



                        MoneyInput::make('rent_value')

                            ->label('Aluguel')

                            ->required(),



                        MoneyInput::make('condominium_value')

                            ->label('Condomínio')

                            ->default(0),



                        MoneyInput::make('iptu_value')

                            ->label('IPTU')

                            ->default(0),



                        MoneyInput::make('deposit_value')

                            ->label('Caução')

                            ->default(0),



                        TextInput::make('due_day')

                            ->label('Dia vencimento')

                            ->numeric()

                            ->default(10),



                        TextInput::make('payment_method')

                            ->label('Forma pagamento'),



                    ])

                    ->columns(2),





                Section::make('Participantes')

                    ->schema([



                        Repeater::make('people')

                            ->label('Pessoas vinculadas')

                            ->relationship()

                            ->schema([



                                Select::make('person_id')

                                    ->label('Pessoa')

                                    ->relationship(
                                        'person',
                                        'name'
                                    )

                                    ->searchable()

                                    ->preload()

                                    ->required(),



                                Select::make('role')

                                    ->label('Função')

                                    ->options([


                                        'owner' =>
                                            'Proprietário',


                                        'tenant' =>
                                            'Locatário',


                                        'guarantor' =>
                                            'Fiador',


                                    ])

                                    ->required(),



                            ])

                            ->columns(2)

                            ->defaultItems(1),



                    ]),





                Section::make('Observações')

                    ->schema([


                        Textarea::make('notes')

                            ->label('Observações')

                            ->columnSpanFull(),



                    ]),



            ]);
    }
}
