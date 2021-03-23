<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Models\DishesOrigine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user(); // Récupération de l'utilisateur actuel
        $origine = DishesOrigine::all();
        $dishes = Dishes::with(['ingredients', 'origine', 'type', 'typeFood'])->get();
        foreach ($dishes as $item) {
            print_r($item.'</br>');
        }
        return view('home', $user);
    }
}
