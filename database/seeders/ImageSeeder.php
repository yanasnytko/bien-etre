<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        // Pour les images polymorphiques, ici nous créons 10 images 
        // sans les lier à une ressource, ou tu peux spécifier 'imageable_id' et 'imageable_type' si nécessaire.
        Image::factory(10)->create();
    }
}
