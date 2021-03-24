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
        $user = Auth::user(); // Récupération de l'utilisateur actuel
        $dishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray();
        if (isset(request()->search) && request()->search !== " ") {
            $data = [];
            foreach ($dishes as $dish) {
                $find = false;
                foreach ($dish["ingredients"] as $ingredient) if (str_contains($ingredient["libelle"], request()->search)) $find = true;
                foreach ($dish["origine"] as $origine) if (str_contains($origine["libelle"], request()->search)) $find = true;
                foreach ($dish["type"] as $type) if (str_contains($type["libelle"], request()->search)) $find = true;
                foreach ($dish["type_food"] as $typeFood) if (str_contains($typeFood["libelle"], request()->search)) $find = true;
                if (str_contains($dish["libelle"], request()->search)) $find = true;
                if ($find === true) $data[] = $dish;
            }
            $dishes = $data;
        }
        $datalist = [];
        $ingredient = Ingredient::all()->toArray();
        $origine = DishesOrigine::all()->toArray();
        $type = DishesType::all()->toArray();
        $typeFood = DishesTypeFood::all()->toArray();
        $dataDishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray();
        foreach ($dataDishes as $item) $datalist[] = "🍕 ".$item["libelle"];
        foreach ($ingredient as $item) $datalist[] = "🍑 ".$item["libelle"];
        foreach ($origine as $item) $datalist[] = "🏳 ".$item["libelle"];
        foreach ($type as $item) $datalist[] = "🍽 ".$item["libelle"];
        foreach ($typeFood as $item) $datalist[] = "🌾 ".$item["libelle"];
        return view('home', ['dishes' => $dishes, 'datalist' => $datalist, "ingredients" => $ingredient]);
    }
}
