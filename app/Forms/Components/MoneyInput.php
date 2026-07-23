<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class MoneyInput extends Field
{
    protected string $view = 'forms.components.money-input';


    public static function make(?string $name = null): static
    {
        return parent::make($name);
    }


    protected function setUp(): void
    {
        parent::setUp();


        $this->dehydrateStateUsing(function ($state) {


            if (blank($state)) {

                return null;

            }


            return number_format(

                ((int) preg_replace('/\D/', '', $state)) / 100,

                2,

                '.',

                ''

            );

        });

    }
}
