<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //el usuario debe estar autenticado
        $user = Auth::user();
        if(in_array($user->rol, $roles))
        return $next($request);
        return response()->json(['error'=>"No puedes acceder a este recurso"], 403);
    }
}
