<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Stage;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer quelques éléments pour chaque section
        $serviceProviders = ServiceProvider::latest()->limit(8)->get();
        $services = Service::latest()->limit(8)->get();
        $stages = Stage::where('display_start', '<=', now())
            ->where('display_end', '>=', now())
            ->orderBy('date_start')
            ->take(8)
            ->get();
        $promotions = Promotion::where('display_start', '<=', now())
        ->where('display_end', '>=', now())
        ->orderBy('date_start')
        ->take(8)
        ->get();

        return view('home', compact('serviceProviders', 'services', 'stages', 'promotions'));
    }
}
