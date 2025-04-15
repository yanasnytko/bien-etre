<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocaliteFactory extends Factory
{
    protected $model = \App\Models\Localite::class;
    
    public function definition()
    {
        return [
            'city'        => $this->faker->city,
            'province'    => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'is_active'   => true,
        ];
    }
}
