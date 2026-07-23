<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
    case CANCELLED = 'cancelled';


    public function label(): string
    {
        return match($this) {

            self::PENDING =>
                'Pendente',

            self::PAID =>
                'Pago',

            self::OVERDUE =>
                'Vencido',

            self::CANCELLED =>
                'Cancelado',

        };
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($item) => [
                $item->value => $item->label()
            ])
            ->toArray();
    }
}
