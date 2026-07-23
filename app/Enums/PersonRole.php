<?php

namespace App\Enums;

enum PersonRole: string
{
    case OWNER = 'owner';
    case LANDLORD = 'landlord';
    case TENANT = 'tenant';
    case GUARANTOR = 'guarantor';
    case PROVIDER = 'provider';
    case EMPLOYEE = 'employee';

    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'Proprietário',
            self::LANDLORD => 'Locador',
            self::TENANT => 'Locatário',
            self::GUARANTOR => 'Fiador',
            self::PROVIDER => 'Prestador',
            self::EMPLOYEE => 'Funcionário',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $role) => [
                $role->value => $role->label(),
            ])
            ->toArray();
    }
}
