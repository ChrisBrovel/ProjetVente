<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'prix', 'quantite', 'image', 'categorie_id', 'vendeur_id'];

    //RELATIONS
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function vendeur()
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    public function commander_des_articles()
    {
        return $this->hasMany(Commander_des_articles::class);
    }
}