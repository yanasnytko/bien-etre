<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    // Indique le nom du modèle associé à cette Factory
    protected $model = \App\Models\User::class;
    
    public function definition()
    {
        return [
            'lastname'      => $this->faker->lastName,
            'firstname'     => $this->faker->firstName,
            'email'         => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'      => bcrypt('password'), // mot de passe par défaut
            'register_date' => now(),
            'user_type'     => 'user',             // ou 'admin', 'provider', selon tes besoins
            'newsletter'    => $this->faker->boolean,
            'trials'        => $this->faker->numberBetween(0, 10),
            'is_provider'   => false,
            'is_banned'     => false,
            'is_verified'   => true,
            'is_active'     => true,
            'remember_token'=> Str::random(10),
        ];
    }
}
