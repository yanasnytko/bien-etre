<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\Service;

class ServiceProviderSeeder extends Seeder
{
    public function run(): void
    {
        // On boucle sur un certain nombre de Users
        // et on crée explicitement un prestataire pour chacun

        User::inRandomOrder()
            ->take(10)     // par exemple les 10 premiers users
            ->get()
            ->each(function (User $user) {
                $provider = ServiceProvider::factory()->make();
                // s'assurer que le provider est lié à ce user
                $provider->user_id = $user->id;
                $provider->save();

                // Optionnel : assigner 1 à 3 catégories (services) au hasard
                $services = Service::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $provider->services()->sync($services);
        });
    }
}
