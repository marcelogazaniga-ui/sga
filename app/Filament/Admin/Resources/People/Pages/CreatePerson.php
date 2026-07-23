<?php

namespace App\Filament\Admin\Resources\People\Pages;

use App\Filament\Admin\Resources\People\PersonResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{
    protected static string $resource = PersonResource::class;

    protected function afterCreate(): void
    {
        $roles = $this->data['roles'] ?? [];

        $this->record->roles()->delete();

        foreach ($roles as $role) {
            $this->record->roles()->create([
                'role' => $role,
            ]);
        }
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['roles']);

        return $data;
    }
}
