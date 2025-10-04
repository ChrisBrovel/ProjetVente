<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['commande_id', 'montant', 'methode', 'status', 'transaction_ref'];

    //RELATIONS
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
