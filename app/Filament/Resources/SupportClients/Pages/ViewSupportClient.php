<?php

namespace App\Filament\Resources\SupportClients\Pages;

use App\Filament\Resources\SupportClients\SupportClientResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSupportClient extends ViewRecord
{
    protected static string $resource = SupportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
