<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    protected $model = \App\Models\Stage::class;
    
    public function definition()
    {
        return [
            // Relation vers ServiceProvider avec factory
            'service_provider_id' => \App\Models\ServiceProvider::factory(),
            'name'                => $this->faker->sentence(3),
            'description'         => $this->faker->paragraph,
            'date_start'          => $this->faker->dateTimeBetween('-1 years', 'now'),
            'date_end'            => $this->faker->dateTimeBetween('now', '+1 years'),
            'display_start'       => $this->faker->dateTimeBetween('-1 years', 'now'),
            'display_end'         => $this->faker->dateTimeBetween('now', '+1 years'),
            'cost'                => $this->faker->randomFloat(2, 10, 500),
            'currency'            => 'EUR',
            'image'               => $this->faker->imageUrl(300, 200, 'education'),
            'is_active'           => true,
        ];
    }
}
