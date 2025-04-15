<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 stages
        Stage::factory(10)->create();
    }
}
