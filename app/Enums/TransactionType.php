<?php

namespace App\Enums;

enum TransactionType: string
{
    case RENT = 'rent';
    case CONDOMINIUM = 'condominium';
    case IPTU = 'iptu';
    case FINE = 'fine';
    case INTEREST = 'interest';
    case OTHER = 'other';


    public function label(): string
    {
        return match($this) {

            self::RENT =>
                'Aluguel',

            self::CONDOMINIUM =>
                'Condomínio',

            self::IPTU =>
                'IPTU',

            self::FINE =>
                'Multa',

            self::INTEREST =>
                'Juros',

            self::OTHER =>
                'Outros',

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
