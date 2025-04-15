<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Localite;

class LocaliteSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 localités
        Localite::factory(10)->create();
    }
}
