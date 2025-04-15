<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 20 utilisateurs par exemple
        User::factory(20)->create();
    }
}
