<?php

namespace App\Support\Forms;

use Filament\Forms\Components\TextInput;
use App\Services\ViaCepService;

class CepInput
{
    public static function make(string $name): TextInput
    {
        return TextInput::make($name)
            ->label('CEP')
            ->mask('99999-999')
            ->maxLength(9)
            ->live()
            ->afterStateUpdated(function ($state, callable $set) {

                if (! $state) {
                    return;
                }

                $address = app(ViaCepService::class)
                    ->search($state);

                if (! $address) {
                    return;
                }

                $set('address', $address['address']);
                $set('district', $address['district']);
                $set('city', $address['city']);
                $set('state', $address['state']);
            });
    }
}
