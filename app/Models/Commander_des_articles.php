<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commander_des_articles extends Model
{
    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prix'];

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
