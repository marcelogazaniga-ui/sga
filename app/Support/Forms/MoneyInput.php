<?php

namespace App\Support\Forms;

use Filament\Forms\Components\TextInput;

class MoneyInput
{
    public static function make(string $name): TextInput
    {
        return TextInput::make($name)
            ->label('Valor')
            ->numeric()
            ->prefix('R$')
            ->default(0);
    }
}
