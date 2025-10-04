<?php

namespace App\Filament\Resources\SupportClients\Pages;

use App\Filament\Resources\SupportClients\SupportClientResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSupportClient extends EditRecord
{
    protected static string $resource = SupportClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
