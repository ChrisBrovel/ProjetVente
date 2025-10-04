<?php

namespace App\Filament\Resources\SupportClients;

use App\Filament\Resources\SupportClients\Pages\CreateSupportClient;
use App\Filament\Resources\SupportClients\Pages\EditSupportClient;
use App\Filament\Resources\SupportClients\Pages\ListSupportClients;
use App\Filament\Resources\SupportClients\Pages\ViewSupportClient;
use App\Filament\Resources\SupportClients\Schemas\SupportClientForm;
use App\Filament\Resources\SupportClients\Schemas\SupportClientInfolist;
use App\Filament\Resources\SupportClients\Tables\SupportClientsTable;
use App\Models\SupportClient;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupportClientResource extends Resource
{
    protected static ?string $model = SupportClient::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return SupportClientForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SupportClientInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SupportClientsTable::configure($table);
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
            'index' => ListSupportClients::route('/'),
            'create' => CreateSupportClient::route('/create'),
            'view' => ViewSupportClient::route('/{record}'),
            'edit' => EditSupportClient::route('/{record}/edit'),
        ];
    }
}
