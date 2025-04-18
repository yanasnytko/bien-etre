<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceProviderFactory extends Factory
{
    protected $model = \App\Models\ServiceProvider::class;

    public function definition()
    {
        $imageId = rand(0, 1084);
        $imageUrl = "https://picsum.photos/id/{$imageId}/400/300";
        return [
            // On suppose que le service provider est lié à un User. Pour la relation, on peut utiliser la factory de User.
            'user_id'       => \App\Models\User::factory(),
            'logo'          => $imageUrl,
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
