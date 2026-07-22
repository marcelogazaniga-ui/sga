<?php

namespace App\Enums;

enum PersonType:string
{
    case OWNER = 'owner';
    case TENANT = 'tenant';
    case GUARANTOR = 'guarantor';
    case SUPPLIER = 'supplier';
    case EMPLOYEE = 'employee';


    public function label(): string
    {
        return match($this)
        {
            self::OWNER => 'Proprietário',
            self::TENANT => 'Inquilino',
            self::GUARANTOR => 'Fiador',
            self::SUPPLIER => 'Fornecedor',
            self::EMPLOYEE => 'Funcionário',
        };
    }
}
