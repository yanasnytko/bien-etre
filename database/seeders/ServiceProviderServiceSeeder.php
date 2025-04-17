<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceProvider;
use App\Models\Service;
use Illuminate\Support\Arr;

class ServiceProviderServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Récupère tous les IDs des services
        $serviceIds = Service::pluck('id')->toArray();

        // Pour chaque prestataire, on lui attache 1 à 4 services aléatoires
        ServiceProvider::all()->each(function ($provider) use ($serviceIds) {
            // On choisit un sous-ensemble unique (1 à 4 services)
            $randomIds = Arr::random(
                $serviceIds,
                rand(1, min(4, count($serviceIds)))
            );

            // sync remplace les anciens liens, insert ceux-ci
            $provider->services()->sync($randomIds);
        });
    }
}
