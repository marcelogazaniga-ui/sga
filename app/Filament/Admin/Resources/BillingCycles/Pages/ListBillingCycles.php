<?php

namespace App\Filament\Admin\Resources\BillingCycles\Pages;

use App\Filament\Admin\Resources\BillingCycles\BillingCycleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBillingCycles extends ListRecords
{
    protected static string $resource = BillingCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
