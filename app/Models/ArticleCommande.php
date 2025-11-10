<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class ArticleCommande extends Model
{
    
    use SoftDeletes;

    // Nom de la table dans la base de données
    protected $table = 'article_commandes';

    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prix'];


     // Colonnes considérées comme des dates
    protected $dates = ['deleted_at'];


    //RELATIONS
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
