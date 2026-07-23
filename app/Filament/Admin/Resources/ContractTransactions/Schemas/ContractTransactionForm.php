<?php

namespace App\Filament\Admin\Resources\ContractTransactions\Schemas;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Forms\Components\MoneyInput;
use App\Models\ContractTransaction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;

class ContractTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Select::make('contract_id')

                    ->label('Contrato')

                    ->relationship(
                        'contract',
                        'codigo'
                    )

                    ->searchable()

                    ->preload()

                    ->live()

                    ->required(),



                Select::make('type')

                    ->label('Tipo')

                    ->options(function (Get $get) {


                        $contractId = $get('contract_id');


                        if (!$contractId) {

                            return TransactionType::options();

                        }


                        $usedTypes = ContractTransaction::query()

                            ->where('contract_id', $contractId)

                            ->whereIn('type', [

                                TransactionType::RENT->value,

                                TransactionType::CONDOMINIUM->value,

                                TransactionType::IPTU->value,

                            ])

                            ->pluck('type')

                            ->map(fn($type) => $type instanceof TransactionType
                                ? $type->value
                                : $type
                            )

                            ->toArray();



                        return collect(TransactionType::options())

                            ->reject(function ($label, $value) use ($usedTypes) {

                                return in_array(
                                    $value,
                                    $usedTypes
                                );

                            })

                            ->toArray();


                    })

                    ->required(),



                TextInput::make('description')

                    ->label('Descrição')

                    ->required()

                    ->maxLength(255),



                DatePicker::make('due_date')

                    ->label('Vencimento')

                    ->required(),



                MoneyInput::make('value')

                    ->label('Valor')

                    ->required(),



                Select::make('status')

                    ->label('Status')

                    ->options(
                        TransactionStatus::options()
                    )

                    ->default('pending')

                    ->required(),



                DatePicker::make('payment_date')

                    ->label('Data Pagamento'),



                Textarea::make('notes')

                    ->label('Observações')

                    ->columnSpanFull(),



            ]);
    }
}
