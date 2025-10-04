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
                Select::make('status')
                    ->options([
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'livré' => 'Livré',
            'annulé' => 'Annulé',
        ])
                    ->default('en_attente')
                    ->required(),
                TextInput::make('ùontant_total')
                    ->required()
                    ->numeric(),
            ]);
    }
}
