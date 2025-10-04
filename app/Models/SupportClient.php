<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportClient extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'reponse'];

    //RELATIONS
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}