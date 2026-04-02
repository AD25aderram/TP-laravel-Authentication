<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Vérifie que l'utilisateur est connecté ET a le bon rôle
        if (auth('api')->user()->role !== $role) {
            return response()->json(['error' => 'Accès refusé'], 403);
        }

        return $next($request);
    }
}