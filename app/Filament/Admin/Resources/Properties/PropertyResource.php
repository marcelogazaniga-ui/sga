<?php

namespace App\Filament\Admin\Resources\Properties;

use App\Filament\Admin\Resources\Properties\Pages\CreateProperty;
use App\Filament\Admin\Resources\Properties\Pages\EditProperty;
use App\Filament\Admin\Resources\Properties\Pages\ListProperties;
use App\Filament\Admin\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Admin\Resources\Properties\Tables\PropertiesTable;
use App\Models\Property;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $modelLabel = 'Imóvel';

    protected static ?string $pluralModelLabel = 'Imóveis';

    protected static ?string $navigationLabel = 'Imóveis';

    protected static string|UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertiesTable::configure($table);
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
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
