<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceProvider;

class ServiceProviderSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 10 prestataires de services
        ServiceProvider::factory(10)->create();
    }
}
