<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
   use HasFactory;

   protected $fillable = ['user_id', 'titre', 'message','type', 'lu_le']; 
    //RELATIONS
    
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
