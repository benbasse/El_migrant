<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            // Vérifie si l'utilisateur a le rôle 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request); // Continue l'exécution de la requête
            }
        }

        // Si l'utilisateur n'est pas authentifié ou n'a pas le rôle 'admin'
        return response()->json(['error' => 'Non autorisé.'], 403);
    }
}
