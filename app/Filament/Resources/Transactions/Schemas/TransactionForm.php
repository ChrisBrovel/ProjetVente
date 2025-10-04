<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('commande_id')
                    ->required()
                    ->numeric(),
                TextInput::make('montant')
                    ->required()
                    ->numeric(),
                Select::make('methode')
                    ->options(['Liquide' => 'Carte bancaire','liquide'=>'Liquide', 'mobile_money'=> 'Mobile money'])
                    ->default('liquide')
                    ->required(),
                Select::make('status')
                    ->options(['en_attente' => 'En attente', 'réussi' => 'Réussi', 'échoué' => 'Échoué'])
                    ->default('en_attente')
                    ->required(),
                TextInput::make('transaction_ref')
                    ->required(),
            ]);
    }
}
