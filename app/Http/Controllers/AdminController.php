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
    public function  indexAdd() { // Affiche l'index de l'ajout d'un plat
        $ingredient = Ingredient::all()->toArray(); // Récupère les ingrédients
        $origines = DishesOrigine::all()->toArray(); // Récupère les Origines
        $type = DishesType::all()->toArray(); // Récupère les Types
        $typeFood = DishesTypeFood::all()->toArray(); // Récupère les Types de nourritures

        // Création de la vue
        return view('admin.add', [
            "ingredients" => $ingredient,
            "origines" => $origines,
            "types" => $type,
            "typeFoods" => $typeFood
        ]);
    }
    public function  indexShow() { // Affiche l'index pour modifier ou supprimer des plats
        $dishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray(); // Récupère les plats
        if (isset(request()->search) && request()->search !== " ") { // Vérification si le plat convient à la recherche
            $data = [];
            foreach ($dishes as $dish) {
                $find = false;
                foreach ($dish["ingredients"] as $ingredient) if (str_contains($ingredient["libelle"], request()->search)) $find = true;
                if (str_contains($dish["origine"]["libelle"], request()->search)) $find = true; // Vérification Origine
                if (str_contains($dish["type"]["libelle"], request()->search)) $find = true; // Vérification Type
                if (str_contains($dish["type_food"]["libelle"], request()->search)) $find = true; // Vérification Type de nourriture
                if (str_contains($dish["libelle"], request()->search)) $find = true; // Vérification nom du plat
                if ($find === true) $data[] = $dish;
            }
            $dishes = $data;
        }
        $datalist = [];
        $ingredient = Ingredient::all()->toArray(); // Récupère les ingrédients
        $origine = DishesOrigine::all()->toArray(); // Récupère les Origines
        $type = DishesType::all()->toArray(); // Récupère les Types
        $typeFood = DishesTypeFood::all()->toArray(); // Récupère les Types de nourritures
        $dataDishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get()->toArray();
        // Implementation de tout les mots recherchable
        foreach ($dataDishes as $item) $datalist[] = "🍕 ".$item["libelle"];
        foreach ($ingredient as $item) $datalist[] = "🍑 ".$item["libelle"];
        foreach ($origine as $item) $datalist[] = "🏳 ".$item["libelle"];
        foreach ($type as $item) $datalist[] = "🍽 ".$item["libelle"];
        foreach ($typeFood as $item) $datalist[] = "🌾 ".$item["libelle"];

        // Création de la vue
        return view('admin.show', ['dishes' => $dishes, 'datalist' => $datalist, "ingredients" => $ingredient]);
    }
    public function store(DishesRequest $dishes) { // Création d'un plat
        $dish = Dishes::create(request()->all()["data"]);
        $data = request()->all()["data"];
        foreach ($data["ingredients"] as $ingredient) { // Boucle sur les ingrédients
            $ingredient = Ingredient::firstOrCreate( // Récupère l'ingrédient ou le crée si il existe pas
                ['libelle' => $ingredient],
            );
            $dish->ingredients()->attach($ingredient->id); // Relie un ingrédient à un plat
        }
        return ["success" => true];
    }
    public function update(DishesRequest $dishes) { // Mets à jour les plats
        $data = request()->all()["data"];
        $dishe = Dishes::find($data["id"]);
        $disheArray = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find($data["id"])->toArray();
        foreach ($disheArray["ingredients"] as $item) { // Boucle sur les ingrédients
            $dishe->ingredients()->detach($item["id"]); // Détache un ingrédient à un plat
        }
        $dishe->delete(); // Supprime le plat
        $dishe = Dishes::create(request()->all()["data"]); // Crée le nouveau plat
        foreach ($data["ingredients"] as $ingredient) { // Boucle sur les ingrédients
            $ingredient = Ingredient::firstOrCreate( // Récupère l'ingrédient ou le crée si il existe pas
                ['libelle' => $ingredient],
            );
            $dishe->ingredients()->attach($ingredient->id); // Relie un ingrédient à un plat
        }
        return ["success" => true];
    }
    public function delete() { // Supprime un plat
        $dishe = Dishes::find(request()->id); // Recherche un plat
        if ($dishe) {
            $disheArray = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find(request()->id)->toArray();
            foreach ($disheArray["ingredients"] as $item) { // Boucle sur les ingrédients
                $dishe->ingredients()->detach($item["id"]); // Détache un ingrédient à un plat
            }
            $dishe->delete(); // Supprime le plat
        }
        // Redirection
        return redirect("/admin/show");
    }
    public function indexEdit() { // Affiche la page d'édition
        $dishe = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find(request()->id)->toArray(); // Récupère un tableau du plat
        $ingredient = Ingredient::all()->toArray(); // Récupère les ingrédients
        $origines = DishesOrigine::all()->toArray(); // Récupère les Origines
        $type = DishesType::all()->toArray(); // Récupère les Types
        $typeFood = DishesTypeFood::all()->toArray(); // Récupère les Types de nourritures

        // Création de la vue
        return view('admin.edit', [
            'dishe' => $dishe,
            "ingredients" => $ingredient,
            "origines" => $origines,
            "types" => $type,
            "typeFoods" => $typeFood
        ]);
    }
}
