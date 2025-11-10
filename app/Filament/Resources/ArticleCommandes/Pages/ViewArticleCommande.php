<?php

namespace App\Filament\Resources\ArticleCommandes\Pages;

use App\Filament\Resources\ArticleCommandes\ArticleCommandeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArticleCommande extends ViewRecord
{
    protected static string $resource = ArticleCommandeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
