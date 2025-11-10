<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Commande extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'status','moyen_de_payement', 'montant_total','adresse_livraison','date_commande'];

    //RELATIONS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article_commandes()
    {
        return $this->hasMany(Article_commandes::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
