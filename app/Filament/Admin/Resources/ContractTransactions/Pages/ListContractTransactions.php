<?php

namespace App\Filament\Admin\Resources\ContractTransactions\Pages;

use App\Filament\Admin\Resources\ContractTransactions\ContractTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContractTransactions extends ListRecords
{
    protected static string $resource = ContractTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
