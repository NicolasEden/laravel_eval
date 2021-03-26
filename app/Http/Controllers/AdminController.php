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
    public function  indexShow() {
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
        return view('admin.show', ['dishes' => $dishes, 'datalist' => $datalist, "ingredients" => $ingredient]);
    }
    public function store(DishesRequest $dishes) {
        $dish = Dishes::create(request()->all()["data"]);
        $data = request()->all()["data"];
        foreach ($data["ingredients"] as $ingredient) {
            $ingredient = Ingredient::firstOrCreate(
                ['libelle' => $ingredient],
            );
            $dish->ingredients()->attach($ingredient->id);
        }
        return ["success" => true];
    }
    public function update(DishesRequest $dishes) {
        $data = request()->all()["data"];
        $dishe = Dishes::find($data["id"]);
        $disheArray = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find($data["id"])->toArray();
        foreach ($disheArray["ingredients"] as $item) {
            $dishe->ingredients()->detach($item["id"]);
        }
        $dishe->delete();
        $dishe = Dishes::create(request()->all()["data"]);
        foreach ($data["ingredients"] as $ingredient) {
            $ingredient = Ingredient::firstOrCreate(
                ['libelle' => $ingredient],
            );
            $dishe->ingredients()->attach($ingredient->id);
        }
        return ["success" => true];
    }
    public function delete() {
        $dishe = Dishes::find(request()->id);
        if ($dishe) {
            $disheArray = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find(request()->id)->toArray();
            foreach ($disheArray["ingredients"] as $item) {
                $dishe->ingredients()->detach($item["id"]);
            }
            $dishe->delete();
        }
        return redirect("/admin/show");
    }
    public function indexEdit() {
        $dishe = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find(request()->id)->toArray();
        $ingredient = Ingredient::all()->toArray();
        $origines = DishesOrigine::all()->toArray();
        $type = DishesType::all()->toArray();
        $typeFood = DishesTypeFood::all()->toArray();
        return view('admin.edit', [
            'dishe' => $dishe,
            "ingredients" => $ingredient,
            "origines" => $origines,
            "types" => $type,
            "typeFoods" => $typeFood
        ]);
    }
}
