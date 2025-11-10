<?php

namespace App\Filament\Resources\ArticleCommandes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArticleCommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('commande_id')
                    ->numeric(),
                TextEntry::make('produit_id')
                    ->numeric(),
                TextEntry::make('quantite')
                    ->numeric(),
                TextEntry::make('prix')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
