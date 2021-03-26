<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Models\DishesOrigine;
use App\Models\DishesType;
use App\Models\DishesTypeFood;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $dishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray(); // Récupération d'un tableau avec tout les plats
        if (isset(request()->search) && request()->search !== " ") { // Vérification si le plat convient à la recherche
            $data = [];
            foreach ($dishes as $dish) {
                $find = false;
                foreach ($dish["ingredients"] as $ingredient) if (str_contains($ingredient["libelle"], request()->search)) $find = true; // Vérification ingrédients
                if (str_contains($dish["origine"]["libelle"], request()->search)) $find = true; // Vérification Origine
                if (str_contains($dish["type"]["libelle"], request()->search)) $find = true; // Vérification Type
                if (str_contains($dish["type_food"]["libelle"], request()->search)) $find = true; // Vérification Type de nourriture
                if (str_contains($dish["libelle"], request()->search)) $find = true; // Vérification nom du plat
                if ($find === true) $data[] = $dish;
            }
            $dishes = $data;
        }
        // Implementation de tout les mots recherchable
        $datalist = [];
        $ingredient = Ingredient::all()->toArray(); // Récupère les ingrédients
        $origine = DishesOrigine::all()->toArray(); // Récupère les Origines
        $type = DishesType::all()->toArray(); // Récupère les Types
        $typeFood = DishesTypeFood::all()->toArray(); // Récupère les Types de nourritures
        $dataDishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray();
        foreach ($dataDishes as $item) $datalist[] = "🍕 ".$item["libelle"];
        foreach ($ingredient as $item) $datalist[] = "🍑 ".$item["libelle"];
        foreach ($origine as $item) $datalist[] = "🏳 ".$item["libelle"];
        foreach ($type as $item) $datalist[] = "🍽 ".$item["libelle"];
        foreach ($typeFood as $item) $datalist[] = "🌾 ".$item["libelle"];

        // Création de la vue
        return view('home', ['dishes' => $dishes, 'datalist' => $datalist, "ingredients" => $ingredient]);
    }
}
