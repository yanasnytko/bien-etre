<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = \App\Models\Service::class;
    
    public function definition()
    {
        return [
            'name'        => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'featured'    => $this->faker->boolean(20),  // 20% de chance d'être featured
            'is_active'   => true,
        ];
    }
}
