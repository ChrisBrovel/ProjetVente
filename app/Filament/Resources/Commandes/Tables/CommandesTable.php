<?php

namespace App\Filament\Resources\Commandes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommandesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('user.name')
    ->label('Client')
    ->sortable()
    ->searchable(),

                TextColumn::make('status'),
                TextColumn::make('moyen_de_payement'),
               
                TextColumn::make('montant_total')
                    ->numeric()
                    ->sortable(),

                    TextColumn::make('adresse_livraison')
    ->label('Adresse livraison')
    ->searchable(),

                    
                     TextColumn::make('date_commande')
    ->label('Date de commande')
    ->date()
    ->sortable(),



                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                        
     Action::make('delete')
        ->label('Supprimer')
        ->icon('heroicon-o-trash')
        ->color('danger')
        ->requiresConfirmation()
        ->action(fn ($record) => $record->delete())
        ->visible(fn ($record) => ! $record->trashed()),

    Action::make('restore')
        ->label('Restaurer')
        ->icon('heroicon-o-arrow-path')
        ->color('success')
        ->action(fn ($record) => $record->restore())
        ->visible(fn ($record) => $record->trashed()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
