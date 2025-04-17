<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Favorite;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\Stage;
use App\Models\Promotion;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition()
    {
        // Choix aléatoire d’une entité « favoriteable »
        $types = [
            ServiceProvider::class,
            Stage::class,
            Promotion::class,
        ];
        $type = $this->faker->randomElement($types);
        $instance = $type::factory()->create();

        return [
            'user_id'              => User::factory()->create()->id,
            'favoriteable_id'      => $instance->id,
            'favoriteable_type'    => $type,
        ];
    }
}
