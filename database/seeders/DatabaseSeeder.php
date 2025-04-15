<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Appelle les seeders
        $this->call([
            UserSeeder::class,
            LocaliteSeeder::class,
            AddressSeeder::class,
            ServiceSeeder::class,
            ServiceProviderSeeder::class,
            CategorieProposalSeeder::class,
            StageSeeder::class,
            PromotionSeeder::class,
            CommentSeeder::class,
            AbuseSeeder::class,
            NewsletterSubscriptionSeeder::class,
            FavoriteSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
