<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('commande_id')
                    ->numeric(),
                TextEntry::make('montant')
                    ->numeric(),
                TextEntry::make('methode'),
                TextEntry::make('status'),
                TextEntry::make('transaction_ref'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
