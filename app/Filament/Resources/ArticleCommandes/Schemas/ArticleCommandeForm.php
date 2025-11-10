<?php

namespace App\Filament\Resources\ArticleCommandes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ArticleCommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('commande_id')
                    ->required()
                    ->numeric(),
                TextInput::make('produit_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantite')
                    ->required()
                    ->numeric(),
                TextInput::make('prix')
                    ->required()
                    ->numeric(),
            ]);
    }
}
