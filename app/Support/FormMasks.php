<?php

namespace App\Support;

use Filament\Forms\Components\TextInput;

class FormMasks
{

    /**
     * Campo monetário
     *
     * Entrada:
     * 250000
     *
     * Exibição:
     * R$ 2.500,00
     *
     * Banco:
     * 2500.00
     */
    public static function money(string $name): TextInput
    {
        return TextInput::make($name)

            ->prefix('R$')

            ->numeric()

            ->formatStateUsing(function ($state) {

                if (blank($state)) {

                    return null;

                }


                return number_format(
                    $state,
                    2,
                    ',',
                    '.'
                );

            })


            ->dehydrateStateUsing(function ($state) {

                if (blank($state)) {

                    return null;

                }


                return number_format(

                    (float) str_replace(
                        ['.', ','],
                        ['', '.'],
                        $state
                    ),

                    2,

                    '.',

                    ''

                );

            });

    }



    /**
     * Decimal
     */
    public static function decimal(string $name): TextInput
    {
        return TextInput::make($name)

            ->numeric()

            ->formatStateUsing(function ($state) {

                if (blank($state)) {

                    return null;

                }


                return number_format(
                    $state,
                    2,
                    ',',
                    '.'
                );

            })

            ->dehydrateStateUsing(function ($state) {


                if (blank($state)) {

                    return null;

                }


                return str_replace(
                    ',',
                    '.',
                    $state
                );

            });

    }



    /**
     * Inteiro
     */
    public static function integer(string $name): TextInput
    {
        return TextInput::make($name)

            ->numeric();

    }



    /**
     * CEP
     */
    public static function cep(string $name): TextInput
    {
        return TextInput::make($name)

            ->mask('99999-999');

    }

}
