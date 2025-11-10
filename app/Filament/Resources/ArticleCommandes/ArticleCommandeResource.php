<?php

namespace App\Filament\Resources\ArticleCommandes;

use App\Filament\Resources\ArticleCommandes\Pages\CreateArticleCommande;
use App\Filament\Resources\ArticleCommandes\Pages\EditArticleCommande;
use App\Filament\Resources\ArticleCommandes\Pages\ListArticleCommandes;
use App\Filament\Resources\ArticleCommandes\Pages\ViewArticleCommande;
use App\Filament\Resources\ArticleCommandes\Schemas\ArticleCommandeForm;
use App\Filament\Resources\ArticleCommandes\Schemas\ArticleCommandeInfolist;
use App\Filament\Resources\ArticleCommandes\Tables\ArticleCommandesTable;
use App\Models\ArticleCommande;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleCommandeResource extends Resource
{
    protected static ?string $model = ArticleCommande::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ArticleCommandeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArticleCommandeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticleCommandesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticleCommandes::route('/'),
            'create' => CreateArticleCommande::route('/create'),
            'view' => ViewArticleCommande::route('/{record}'),
            'edit' => EditArticleCommande::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
