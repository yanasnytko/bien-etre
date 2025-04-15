<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceProviderFactory extends Factory
{
    protected $model = \App\Models\ServiceProvider::class;

    public function definition()
    {
        return [
            // On suppose que le service provider est lié à un User. Pour la relation, on peut utiliser la factory de User.
            'user_id'       => \App\Models\User::factory(),
            'logo'          => $this->faker->imageUrl(200, 200, 'business'),
            'company_name'  => $this->faker->company,
            'website'       => $this->faker->url,
            'company_email' => $this->faker->companyEmail,
            'telephone'     => $this->faker->phoneNumber,
            'vat_number'    => $this->faker->numerify('##########'),
            'created_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'description'   => $this->faker->paragraph,
            'is_active'     => true,
        ];
    }
}
