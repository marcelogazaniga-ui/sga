<?php

namespace App\Support\Forms;

use Filament\Forms\Components\TextInput;

class DocumentInput
{
    public static function make(string $name): TextInput
    {
        return TextInput::make($name)
            ->label('CPF / CNPJ')
            ->maxLength(18)
            ->mask('999.999.999-99');
    }
}
