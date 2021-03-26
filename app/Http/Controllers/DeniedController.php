<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeniedController extends Controller
{
    public function index() { // Retourne vers une page si on a pas la permission
        return view('denied');
    }
}
