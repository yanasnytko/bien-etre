<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;
use App\Models\User;
use App\Models\Localite;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'user_id'     => User::inRandomOrder()->first()->id,
            'localite_id' => Localite::inRandomOrder()->first()->id,
            'street'      => $this->faker->streetName,
            'number'      => $this->faker->buildingNumber,
            'is_active'   => true,
        ];
    }
}

