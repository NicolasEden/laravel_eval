<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'dishes', 'pivot'];
    protected $fillable = ["libelle"];
    public function dishes() // Crée la relation n:n avec le plat
    {
        return $this->belongsToMany(Dishes::class);
    }
}
