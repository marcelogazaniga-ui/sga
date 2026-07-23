<?php

namespace App\Filament\Admin\Resources\ContractTransactions\Pages;

use App\Filament\Admin\Resources\ContractTransactions\ContractTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContractTransaction extends EditRecord
{
    protected static string $resource = ContractTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
