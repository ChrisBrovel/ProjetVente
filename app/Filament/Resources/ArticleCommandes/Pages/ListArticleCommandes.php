<?php

namespace App\Filament\Resources\ArticleCommandes\Pages;

use App\Filament\Resources\ArticleCommandes\ArticleCommandeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticleCommandes extends ListRecords
{
    protected static string $resource = ArticleCommandeResource::class;

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
