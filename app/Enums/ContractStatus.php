<?php

namespace App\Enums;

enum ContractStatus: string
{
    case ACTIVE = 'active';
    case FINISHED = 'finished';
    case SUSPENDED = 'suspended';
    case TERMINATED = 'terminated';


    public function label(): string
    {
        return match($this) {

            self::ACTIVE => 'Ativo',
            self::FINISHED => 'Encerrado',
            self::SUSPENDED => 'Suspenso',
            self::TERMINATED => 'Rescisão',

        };
    }


    public static function options(): array
    {
        return [

            self::ACTIVE->value =>
                self::ACTIVE->label(),

            self::FINISHED->value =>
                self::FINISHED->label(),

            self::SUSPENDED->value =>
                self::SUSPENDED->label(),

            self::TERMINATED->value =>
                self::TERMINATED->label(),

        ];
    }
}
