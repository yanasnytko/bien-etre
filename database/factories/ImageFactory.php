<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = \App\Models\Image::class;

    public function definition()
    {
        return [
            'path'  => $this->faker->imageUrl(400, 300, 'nature'),
            // Si tu utilises un champ "type" en tant qu'ENUM, choisis-en une des valeurs autorisées
            'type'  => $this->faker->randomElement(['slider', 'profil', 'service', 'provider']),
            'name'  => $this->faker->word . '.jpg',
            // La relation polymorphique, on doit créer un modèle "imageable".
            // Pour l'exemple, on peut laisser des valeurs nulles et ajuster dans un seeder ou spécifier un modèle concret.
            'imageable_id'   => function () {
                return \App\Models\ServiceProvider::factory()->create()->id;
            },
            'imageable_type' => \App\Models\ServiceProvider::class,
        ];
    }
}
