<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Contracts\OAuthenticatable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Filament\Panel;


class User extends Authenticatable implements FilamentUser
{

     use SoftDeletes;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'avatar',
        

    ];

    //RELATIONS
    public function produits()
    {
        return $this->hasMany(Produit::class,);
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }


    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
   
    }

    //Accès au panneau d'administration Filament
    
    public function canAccessPanel(Panel $panel): bool
{
    return $this->role === 'admin';
}

//recupérer l'avatar
public function getFilamentAvatarUrl(): ?string
{
    if ($this->avatar) {
        // Si ton avatar est dans storage/app/public/avatars
        return asset('storage/' . $this->avatar);
    }

    // fallback si aucun avatar défini
    return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
}

}





