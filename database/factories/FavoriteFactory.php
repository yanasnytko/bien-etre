<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = \App\Models\Favorite::class;

    public function definition()
    {
        return [
            'user_id'             => \App\Models\User::factory(),
            'service_provider_id' => \App\Models\ServiceProvider::factory(),
        ];
    }
}
