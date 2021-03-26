<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanierController extends Controller
{
    public function index() {
        $panier = Panier::with(['dishes'])->get()->toArray()[0]["dishes"];
        $dishes = [];
        foreach ($panier as $item) {
            array_push($dishes, Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->find($item["id"])->toArray());
        }
        return view('panier', ['dishes' => $dishes]);
    }
    public function store() {
        $panier = Panier::firstOrCreate(
            ['id' => Auth::user()->id],
        );
        $dishe = Dishes::find(request()->id);
        $present = DB::table("dishe_paniers")->select("*")->where("panier_id", "=", Auth::user()->id)->where("dishes_id", "=", request()->id)->get()->toArray();
        if ($dishe && sizeof($present) === 0) {
            $panier->dishes()->attach($dishe->id);
        }
        return redirect("/panier");
    }
    public function delete() {
        $panier = Panier::find(Auth::user()->id);
        if (request()->id) {
            $panier->dishes()->detach(request()->id);
        }
        return redirect("/panier");
    }
}
