<?php

namespace App\Filament\Admin\Resources\Contracts;

use App\Filament\Admin\Resources\Contracts\Pages\ViewContract;
use UnitEnum;
use App\Filament\Admin\Resources\Contracts\Pages\CreateContract;
use App\Filament\Admin\Resources\Contracts\Pages\EditContract;
use App\Filament\Admin\Resources\Contracts\Pages\ListContracts;
use App\Filament\Admin\Resources\Contracts\Schemas\ContractForm;
use App\Filament\Admin\Resources\Contracts\Tables\ContractsTable;
use App\Models\Contract;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;


class ContractResource extends Resource
{

    protected static ?string $model = Contract::class;


    protected static ?string $modelLabel = 'Contrato';

    protected static ?string $pluralModelLabel = 'Contratos';


    protected static ?string $navigationLabel = 'Contratos';


    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';


    protected static UnitEnum|string|null $navigationGroup = 'Locações';



    public static function form(Schema $schema): Schema
    {
        return ContractForm::configure($schema);
    }



    public static function table(Table $table): Table
    {
        return ContractsTable::configure($table);
    }


    public static function getPages(): array
    {
     return [
        'index'  => ListContracts::route('/'),
        'create' => CreateContract::route('/create'),
        'view'   => ViewContract::route('/{record}'),
        'edit'   => EditContract::route('/{record}/edit'),
    ];
}
}
