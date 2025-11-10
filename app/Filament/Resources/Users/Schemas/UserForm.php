<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Photo de profil')
                    ->directory('avatars') // 📁 Dossier de stockage dans /storage/app/public/avatars
                    ->image() // Restreint aux fichiers image
                    ->avatar() // Affiche un aperçu circulaire
                    ->maxSize(10240) // 10MB max
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),

                TextInput::make('phone')
                    ->tel()
                    ->default(null),

                TextInput::make('password')
                    ->password()
                    ->required(),

                Select::make('role')
                    ->options([
                        'client' => 'Client',
                        'vendeur' => 'Vendeur',
                        'admin' => 'Admin',
                    ])
                    ->default('client')
                    ->required(),
            ]);
    }
}
