<?php

namespace App\Enums;

enum PropertyPersonRole: string
{
    case OWNER = 'owner';

    case CO_OWNER = 'co_owner';

    case ADMINISTRATOR = 'administrator';

    case BROKER = 'broker';

    case TENANT = 'tenant';

    case ATTORNEY = 'attorney';


    public function label(): string
    {
        return match ($this) {

            self::OWNER =>
                'Proprietário',

            self::CO_OWNER =>
                'Co-Proprietário',

            self::ADMINISTRATOR =>
                'Administrador',

            self::BROKER =>
                'Corretor',

            self::TENANT =>
                'Locatário',

            self::ATTORNEY =>
                'Procurador',

        };
    }


    public static function options(): array
    {
        return collect(self::cases())

            ->mapWithKeys(function ($role) {

                return [

                    $role->value =>
                        $role->label(),

                ];

            })

            ->toArray();
    }
}
