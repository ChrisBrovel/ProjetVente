<?php

namespace App\Filament\Resources\SupportClients\Pages;

use App\Filament\Resources\SupportClients\SupportClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSupportClients extends ListRecords
{
    protected static string $resource = SupportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableWrapperHtmlAttributes(): array
{
    return [
        'class' => 'w-full overflow-x-auto',
    ];
}

}
