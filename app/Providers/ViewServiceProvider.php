<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Attache la variable $services à la vue d'inscription
        View::composer(['auth.register', 'profile.edit'], function ($view) {
            $view->with('services', Service::all());
        });
    }

    public function register()
    {
        //
    }
}
