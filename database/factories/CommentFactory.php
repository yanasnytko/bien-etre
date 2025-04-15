<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;
    
    public function definition()
    {
        return [
            'user_id'             => \App\Models\User::factory(),
            'service_provider_id' => \App\Models\ServiceProvider::factory(),
            'title'               => $this->faker->sentence,
            'content'             => $this->faker->paragraph,
            'date'                => $this->faker->dateTime,
            'rating'              => $this->faker->numberBetween(0, 5),
            'is_abusive'          => false,
        ];
    }
}
