<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'dishes_origines'];
    protected $fillable = ['id', 'prix', 'libelle', 'poids', 'dishes_origines', 'dishes_type_food', 'dishes_types'];
    public function origine()
    {
        return $this->hasMany(DishesOrigine::class, "id");
    }
    public function type()
    {
        return $this->hasMany(DishesType::class, "id");
    }
    public function typeFood()
    {
        return $this->hasMany(DishesTypeFood::class, "id");
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, "dishes_ingredient", "dishes_id", "ingredient_id");
    }
}
