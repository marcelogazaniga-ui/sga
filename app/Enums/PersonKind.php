<?php

namespace App\Enums;

enum PersonKind:string
{
    case INDIVIDUAL = 'individual';

    case COMPANY = 'company';


    public function label(): string
    {
        return match($this)
        {
            self::INDIVIDUAL => 'Pessoa Física',
            self::COMPANY => 'Pessoa Jurídica',
        };
    }
}
