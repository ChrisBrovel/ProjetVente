<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Commande;
use App\Models\Notification;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;


class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Nouvel Utilisateurs' ,User::count())
              ->description('Nombre total des utilisateurs')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->chart([1, 3, 5, 10, 20, 40])
            ->color('success'),
             
             Stat::make('Nombre de commande', Commande::count())
              ->description('Nombre total des commandes')
            ->descriptionIcon('heroicon-m-shopping-cart', IconPosition::Before)
            ->chart([1, 3, 5, 10, 20, 40])
            ->color('success'),




             Stat::make('Notifications', Notification::count())
              ->description('Nombre total des notifications')
            ->descriptionIcon('heroicon-m-bell', IconPosition::Before)
            ->chart([1, 3, 5, 10, 20, 40])
            ->color('success'),
        ];
    }
}
