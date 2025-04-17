<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use App\Models\Localite;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // S’assurer d’abord d’avoir des localites
        Localite::factory()->count(10)->create();

        // Pour chaque User on crée 1 adresse
        User::all()->each(function(User $user) {
            Address::factory()->create([
                'user_id'    => $user->id,
                'localite_id'=> \App\Models\Localite::inRandomOrder()->first()->id,
                'is_active'  => true,
            ]);
        });
    }
}
