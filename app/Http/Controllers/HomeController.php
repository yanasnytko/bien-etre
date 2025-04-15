<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Promotion;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer quelques éléments pour chaque section
        $serviceProviders = ServiceProvider::latest()->limit(8)->get();
        $services = Service::latest()->limit(8)->get();
        $promotions = Promotion::latest()->limit(8)->get();

        return view('home', compact('serviceProviders', 'services', 'promotions'));
    }
}
