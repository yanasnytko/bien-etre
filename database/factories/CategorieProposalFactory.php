<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieProposalFactory extends Factory
{
    protected $model = \App\Models\CategorieProposal::class;
    
    public function definition()
    {
        return [
            // La proposition est liée à un utilisateur ; ici on génère un utilisateur.
            'user_id'       => \App\Models\User::factory(),
            'proposed_name' => $this->faker->word,
            'description'   => $this->faker->sentence,
            // Le status est généralement 'pending' par défaut.
            'status'        => 'pending',
        ];
    }
}
