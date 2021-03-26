<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'dishes_origines'];
    protected $fillable = ['id', 'price', 'libelle', 'weight', 'dishes_origines', 'dishes_type_food', 'dishes_types'];
    public function origine()
    {
        return $this->belongsTo(DishesOrigine::class, "dishes_origines");
    }
    public function type()
    {
        return $this->belongsTo(DishesType::class, "dishes_types");
    }
    public function typeFood()
    {
        return $this->belongsTo(DishesTypeFood::class, "dishes_type_food");
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, "dishes_ingredient", "dishes_id", "ingredient_id");
    }
}
