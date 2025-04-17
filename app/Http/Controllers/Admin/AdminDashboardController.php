<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\Service;
use App\Models\Stage;
use App\Models\Promotion;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Quelques stats globales
        $usersCount            = User::count();
        $providersCount        = ServiceProvider::count();
        $servicesCount         = Service::count();
        $stagesCount           = Stage::count();
        $promotionsCount       = Promotion::count();
        
        return view('admin.dashboard', compact(
            'usersCount',
            'providersCount',
            'servicesCount',
            'stagesCount',
            'promotionsCount',
        ));
    }
}
