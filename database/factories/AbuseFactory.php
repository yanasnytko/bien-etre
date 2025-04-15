<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbuseFactory extends Factory
{
    protected $model = \App\Models\Abuse::class;

    public function definition()
    {
        return [
            // On suppose qu'un abuse est lié à un commentaire existant.
            'comment_id'          => \App\Models\Comment::factory(),
            'reported_by_user_id' => \App\Models\User::factory(),
            'reason'              => $this->faker->sentence,
            'status'              => 'pending',  // ou approved/rejected selon ta logique
        ];
    }
}
