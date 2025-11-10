<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                    //
                Select::make('status')
                    ->options([
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'livré' => 'Livré',
            'annulé' => 'Annulé',
        ])
            ->default('en_attente')
            ->required(),

//
             Select::make('moyen_de_payement')
                    ->options([
            'carte_bancaire' => 'Carte bancaire',
            'mobile_money' => 'Mobile Money',
            
        ])
                    ->default('carte_bancaire')
                    ->required(),
//

                TextInput::make('montant_total')
                    ->required()
                    ->numeric(),

                    TextInput::make('adresse_livraison')
                    ->required(),
            ]);
    }
}
