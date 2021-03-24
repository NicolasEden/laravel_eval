<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishesIngredients extends Model
{
    protected $fillable = ["ingredient_id", "dishes_id"];
}
