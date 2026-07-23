<?php

namespace App\Enums;

enum PropertyStatus: string
{
    case AVAILABLE = 'available';
    case RENTED = 'rented';
    case MAINTENANCE = 'maintenance';
    case BLOCKED = 'blocked';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'Disponível',
            self::RENTED => 'Alugado',
            self::MAINTENANCE => 'Manutenção',
            self::BLOCKED => 'Bloqueado',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $status) => [
                $status->value => $status->label(),
            ])
            ->toArray();
    }
}
