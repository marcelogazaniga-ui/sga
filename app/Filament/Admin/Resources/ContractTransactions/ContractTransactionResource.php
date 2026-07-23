<?php

namespace App\Filament\Admin\Resources\ContractTransactions;

use UnitEnum;
use App\Filament\Admin\Resources\ContractTransactions\Pages\CreateContractTransaction;
use App\Filament\Admin\Resources\ContractTransactions\Pages\EditContractTransaction;
use App\Filament\Admin\Resources\ContractTransactions\Pages\ListContractTransactions;
use App\Filament\Admin\Resources\ContractTransactions\Schemas\ContractTransactionForm;
use App\Filament\Admin\Resources\ContractTransactions\Tables\ContractTransactionsTable;
use App\Models\ContractTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ContractTransactionResource extends Resource
{

    protected static ?string $model = ContractTransaction::class;


    protected static ?string $modelLabel = 'Lançamento Financeiro';

    protected static ?string $pluralModelLabel = 'Lançamentos Financeiros';


    protected static ?string $navigationLabel = 'Financeiro';


    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static UnitEnum|string|null $navigationGroup = 'Locações';



    public static function form(Schema $schema): Schema
    {
        return ContractTransactionForm::configure($schema);
    }



    public static function table(Table $table): Table
    {
        return ContractTransactionsTable::configure($table);
    }



    public static function getPages(): array
    {
        return [
            'index' => ListContractTransactions::route('/'),
            'create' => CreateContractTransaction::route('/create'),
            'edit' => EditContractTransaction::route('/{record}/edit'),
        ];
    }

}
