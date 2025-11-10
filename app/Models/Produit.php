<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Produit extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function article_commandes()
    {
        return $this->hasMany(Article_commandes::class);
    }
}