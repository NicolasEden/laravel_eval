<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanierController extends Controller
{
    public function index() { // Affichage du panier par utilisateur
        $panier = Panier::firstOrCreate( // Récupère ou crée un paneir si il existe pas
            ['id' => Auth::user()->id],
        );
        $panier = Panier::with(['dishes'])->get()->toArray()[0]["dishes"];
        $dishes = [];
        foreach ($panier as $item) {
            array_push($dishes, Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find($item["id"])->toArray());
        }
        return view('panier', ['dishes' => $dishes]);
    }
    public function store() { // Stockage dans le panier d'un plat
        $panier = Panier::firstOrCreate( // Récupère ou crée un paneir si il existe pas
            ['id' => Auth::user()->id],
        );
        $dishe = Dishes::find(request()->id); // Récupère le plat
        $present = DB::table("dishe_paniers")
            ->select("*")
            ->where("panier_id", "=", Auth::user()->id)
            ->where("dishes_id", "=", request()->id)
            ->get()
            ->toArray(); // Vérifie si le plat existe déjà dans le panier
        if ($dishe && sizeof($present) === 0) {
            $panier->dishes()->attach($dishe->id);
        }
        // Création de la vue
        return redirect("/panier");
    }
    public function delete() { // Suppression d'un plat dans le panier
        $panier = Panier::find(Auth::user()->id);
        if (request()->id) {
            $panier->dishes()->detach(request()->id);
        }
        // Création de la vue
        return redirect("/panier");
    }
}
