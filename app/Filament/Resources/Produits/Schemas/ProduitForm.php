<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('prix')
                    ->required()
                    ->numeric(),
                TextInput::make('quantite')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('categorie_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vendeur_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
