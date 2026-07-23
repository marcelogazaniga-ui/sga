<?php

namespace App\Filament\Admin\Resources\ContractTransactions\Pages;

use App\Filament\Admin\Resources\ContractTransactions\ContractTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContractTransaction extends CreateRecord
{
    protected static string $resource = ContractTransactionResource::class;
}
