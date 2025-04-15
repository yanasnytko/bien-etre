<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = \App\Models\Address::class;
    
    public function definition()
    {
        return [
            'street'      => $this->faker->streetName,
            'number'      => $this->faker->buildingNumber,
            'is_active'   => true,
            'localite_id' => \App\Models\Localite::factory(),  // Génère une localite liée
        ];
    }
}
