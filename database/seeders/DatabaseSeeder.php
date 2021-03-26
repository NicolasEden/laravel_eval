<?php

namespace Database\Seeders;

use App\Models\Dishes;
use App\Models\DishesOrigine;
use App\Models\DishesType;
use App\Models\DishesTypeFood;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert(['libelle' => "Jambon"]);
        DB::table('ingredients')->insert(['libelle' => "Gruyere"]);
        DB::table('ingredients')->insert(['libelle' => "Pâte à Pizza"]);
        DB::table('ingredients')->insert(['libelle' => "Craime fraiche"]);
        DB::table('dishes_types')->insert(['libelle' => "Entrée"]);
        DB::table('dishes_types')->insert(['libelle' => "Plat"]);
        DB::table('dishes_types')->insert(['libelle' => "Dessert"]);
        DB::table('dishes_type_food')->insert(['libelle' => "Normal"]);
        DB::table('dishes_type_food')->insert(['libelle' => "Vegan"]);
        DB::table('dishes_type_food')->insert(['libelle' => "Végératien"]);
        DB::table('dishes_type_food')->insert(['libelle' => "Végétalien"]);
        DB::table('dishes_origines')->insert(['libelle' => "Italien"]);
        DB::table('dishes_origines')->insert(['libelle' => "Français"]);
        DB::table('dishes_origines')->insert(['libelle' => "Allemand"]);
    }
}
