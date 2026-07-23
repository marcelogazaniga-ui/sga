<?php

namespace App\Filament\Admin\Resources\People\Pages;

use App\Filament\Admin\Resources\People\PersonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerson extends EditRecord
{
    protected static string $resource = PersonResource::class;


    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['roles'] = $this->record
            ->roles()
            ->pluck('role')
            ->toArray();

        return $data;
    }


    protected function afterSave(): void
    {
        $roles = $this->data['roles'] ?? [];

        $this->record->roles()->delete();

        foreach ($roles as $role) {

            $this->record->roles()->create([
                'role' => $role,
            ]);

        }
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['roles']);

        return $data;
    }


    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
