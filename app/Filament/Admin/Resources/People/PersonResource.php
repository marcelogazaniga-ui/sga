<?php

namespace App\Filament\Admin\Resources\People;

use App\Filament\Admin\Resources\People\Pages\CreatePerson;
use App\Filament\Admin\Resources\People\Pages\EditPerson;
use App\Filament\Admin\Resources\People\Pages\ListPeople;
use App\Filament\Admin\Resources\People\Schemas\PersonForm;
use App\Filament\Admin\Resources\People\Tables\PeopleTable;
use App\Models\Person;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PersonResource extends Resource
{
    protected static ?string $navigationLabel = 'Pessoas';

    protected static string|\UnitEnum|null $navigationGroup = 'Cadastros';

    protected static ?string $modelLabel = 'Pessoa';

    protected static ?string $model = Person::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    public static function form(Schema $schema): Schema
    {
        return PersonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeopleTable::configure($table);
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
            'index' => ListPeople::route('/'),
            'create' => CreatePerson::route('/create'),
            'edit' => EditPerson::route('/{record}/edit'),
        ];
    }
}
