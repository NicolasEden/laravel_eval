<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    public function dishes() // Crée la relation n:n avec le plat
    {
        return $this->belongsToMany(Dishes::class, "dishe_paniers", "panier_id", "dishes_id");
    }
}
