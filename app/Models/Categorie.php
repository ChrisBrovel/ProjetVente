<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    use SoftDeletes;

    protected $fillable = ['nom', 'parent_id'];

    // Relations
    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    // Scopes utiles
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Attributs calculés
    protected $appends = ['nombre_produits'];

    public function getNombreProduitsAttribute()
    {
        return $this->produits()->count();
    }
}
