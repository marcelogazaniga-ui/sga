<?php

namespace App\Filament\Admin\Resources\BillingCycles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BillingCycleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('contract_id')
                    ->relationship('contract', 'id')
                    ->required(),
                TextInput::make('month')
                    ->required()
                    ->numeric(),
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                TextInput::make('total_value')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                DatePicker::make('paid_at'),
            ]);
    }
}
