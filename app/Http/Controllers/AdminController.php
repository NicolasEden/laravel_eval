<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishesRequest;
use App\Models\Dishes;
use App\Models\DishesOrigine;
use App\Models\DishesType;
use App\Models\DishesTypeFood;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        return view('admin.home');
    }
    public function  indexAdd() {
        $ingredient = Ingredient::all()->toArray();
        $origines = DishesOrigine::all()->toArray();
        $type = DishesType::all()->toArray();
        $typeFood = DishesTypeFood::all()->toArray();
        return view('admin.add', [
            "ingredients" => $ingredient,
            "origines" => $origines,
            "types" => $type,
            "typeFoods" => $typeFood
        ]);
    }
    public function store(DishesRequest $dishes) {
        //$dish = Dishes::create(request()->all());
        $data = request()->all();
        print_r($data);
        /*foreach ($data["data"]["ingredients"] as $ingredient) {
            $ingredient = Ingredient::firstOrCreate(
                ['libelle' => $ingredient],
            );
            $dish->ingredients()->attach($ingredient->id);
        }*/
        return ["success" => true];
    }
}
