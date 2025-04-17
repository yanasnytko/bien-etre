<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1) Récupère tous les favoris polymorphiques avec leur modèle parent
        $favorites = $user->favorites()->with('favoriteable')->get();

        // 2) Si c'est un provider, on charge ses stages et promotions
        $stages     = collect();
        $promotions = collect();

        if ($user->is_provider && $user->serviceProvider) {
            $stages     = $user->serviceProvider->stages;
            $promotions = $user->serviceProvider->promotions;
        }

        return view('dashboard', compact('favorites', 'stages', 'promotions'));
    }
}
