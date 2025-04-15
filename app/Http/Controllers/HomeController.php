<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Affiche la page d'accueil
    public function index()
    {
        return view('home'); // La vue se trouve dans resources/views/home.blade.php
    }
}
