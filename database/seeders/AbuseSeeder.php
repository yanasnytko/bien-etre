<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Abuse;

class AbuseSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 abus (signalements)
        Abuse::factory(10)->create();
    }
}
