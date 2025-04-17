<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Si pas connecté ou pas admin
        if (! Auth::check() || Auth::user()->user_type !== 'admin') {
            // Vous pouvez rediriger vers une 403 ou la home
            abort(403, 'Accès réservé aux administrateurs');
        }

        return $next($request);
    }
}
