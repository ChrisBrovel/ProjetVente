<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProduitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titre'),
                TextEntry::make('prix')
                    ->numeric(),
                TextEntry::make('quantite')
                    ->numeric(),
                ImageEntry::make('image'),
                TextEntry::make('categorie_id')
                    ->numeric(),
                TextEntry::make('vendeur_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
