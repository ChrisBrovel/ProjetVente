<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['user_id', 'status','moyen_de_payement', 'montant_total','adresse_livraison','date_commande'];

    //RELATIONS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commander_des_articles()
    {
        return $this->hasMany(Commander_des_articles::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
