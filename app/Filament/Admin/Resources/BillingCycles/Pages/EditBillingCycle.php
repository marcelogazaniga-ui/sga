<?php

namespace App\Filament\Admin\Resources\BillingCycles\Pages;

use App\Filament\Admin\Resources\BillingCycles\BillingCycleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBillingCycle extends EditRecord
{
    protected static string $resource = BillingCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
