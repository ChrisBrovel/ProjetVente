<?php

namespace App\Filament\Resources\ArticleCommandes\Pages;

use App\Filament\Resources\ArticleCommandes\ArticleCommandeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArticleCommande extends EditRecord
{
    protected static string $resource = ArticleCommandeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
