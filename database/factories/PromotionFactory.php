<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    protected $model = \App\Models\Promotion::class;
    
    public function definition()
    {
        return [
            'service_provider_id' => \App\Models\ServiceProvider::factory(),
            'title'               => $this->faker->sentence(4),
            'description'         => $this->faker->paragraph,
            // On suppose qu'un PDF n'est généré que rarement ; on peut mettre null par défaut
            'pdf'                 => null,
            'date_start'          => $this->faker->dateTimeBetween('-1 years', 'now'),
            'date_end'            => $this->faker->dateTimeBetween('now', '+1 years'),
            'display_start'       => $this->faker->dateTimeBetween('-1 years', 'now'),
            'display_end'         => $this->faker->dateTimeBetween('now', '+1 years'),
            'is_active'           => true,
        ];
    }
}
