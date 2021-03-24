<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishesTypeFood extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'dishes', 'pivot'];
    public function dishes()
    {
        return $this->hasMany(Dishes::class);
    }
}
