<?php

namespace App\Filament\Admin\Resources\BillingCycles;

use App\Filament\Admin\Resources\BillingCycles\Pages\CreateBillingCycle;
use App\Filament\Admin\Resources\BillingCycles\Pages\EditBillingCycle;
use App\Filament\Admin\Resources\BillingCycles\Pages\ListBillingCycles;
use App\Filament\Admin\Resources\BillingCycles\Schemas\BillingCycleForm;
use App\Filament\Admin\Resources\BillingCycles\Tables\BillingCyclesTable;
use App\Models\BillingCycle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BillingCycleResource extends Resource
{
    protected static ?string $model = BillingCycle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BillingCycleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BillingCyclesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBillingCycles::route('/'),
            'create' => CreateBillingCycle::route('/create'),
            'edit' => EditBillingCycle::route('/{record}/edit'),
        ];
    }
}
