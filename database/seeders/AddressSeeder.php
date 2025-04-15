<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 20 adresses (si besoin, chaque adresse va générer une localité par la factory, ou tu peux créer des adresses pour des localités existantes)
        Address::factory(20)->create();
    }
}
