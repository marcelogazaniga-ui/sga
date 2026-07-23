<?php

namespace App\Filament\Admin\Resources\Contracts\Pages;

use App\Filament\Admin\Resources\Contracts\ContractResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ViewContract extends ViewRecord
{

    protected static string $resource = ContractResource::class;



    protected function getHeaderActions(): array
    {
        return [

            Action::make('generateBilling')

                ->label('Gerar Cobranças')

                ->icon('heroicon-o-banknotes')

                ->color('success')

                ->requiresConfirmation()

                ->modalHeading('Gerar cobranças')

                ->modalDescription(
                    'Deseja gerar as cobranças deste contrato?'
                )

                ->action(function () {


                    $this->record
                        ->generateBillingCycles();



                    Notification::make()

                        ->title('Cobranças geradas com sucesso')

                        ->success()

                        ->send();


                }),

        ];
    }





    public function infolist(Schema $schema): Schema
    {
        return $schema

            ->components([



                Section::make('Contrato')

                    ->schema([


                        TextEntry::make('codigo')

                            ->label('Código'),



                        TextEntry::make('status')

                            ->label('Status'),



                        TextEntry::make('start_date')

                            ->label('Início')

                            ->date('d/m/Y'),



                        TextEntry::make('end_date')

                            ->label('Fim')

                            ->date('d/m/Y'),

                    ])

                    ->columns(2),





                Section::make('Imóvel')

                    ->schema([


                        TextEntry::make('property.title')

                            ->label('Imóvel'),



                        TextEntry::make('property.city')

                            ->label('Cidade'),



                        TextEntry::make('property.state')

                            ->label('Estado'),

                    ])

                    ->columns(3),





                Section::make('Financeiro')

                    ->schema([


                        TextEntry::make('rent_value')

                            ->label('Aluguel')

                            ->money('BRL'),



                        TextEntry::make('condominium_value')

                            ->label('Condomínio')

                            ->money('BRL'),



                        TextEntry::make('iptu_value')

                            ->label('IPTU')

                            ->money('BRL'),



                        TextEntry::make('deposit_value')

                            ->label('Caução')

                            ->money('BRL'),



                        TextEntry::make('due_day')

                            ->label('Dia vencimento'),

                    ])

                    ->columns(3),





                Section::make('Participantes')

                    ->schema([


                        RepeatableEntry::make('people')

                            ->label('')

                            ->schema([



                                TextEntry::make('person.name')

                                    ->label('Nome'),



                                TextEntry::make('role')

                                    ->label('Função')

                                    ->formatStateUsing(

                                        fn ($state) => match($state) {


                                            'owner' =>
                                                'Proprietário',


                                            'tenant' =>
                                                'Locatário',


                                            'guarantor' =>
                                                'Fiador',


                                            default =>
                                                $state,


                                        }

                                    ),


                            ])

                            ->columns(2),


                    ]),





                Section::make('Observações')

                    ->schema([


                        TextEntry::make('notes')

                            ->label('Observações'),


                    ]),


            ]);

    }

}
