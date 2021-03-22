<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminiCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ce système permet de vérifier si l'utilisateur actif est Administrateur
        if (Auth::user()->administrator === 1) {
            return $next($request);
        }
        return redirect('/denied');
    }
}
