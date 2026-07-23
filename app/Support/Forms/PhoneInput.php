<?php

namespace App\Support\Forms;

use Filament\Forms\Components\TextInput;

class PhoneInput
{
    public static function make(string $name): TextInput
    {
        return TextInput::make($name)
            ->label('Telefone')
            ->tel()
            ->maxLength(15)
            ->placeholder('(00) 00000-0000');
    }
}
