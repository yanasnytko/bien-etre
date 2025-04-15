<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscription;

class NewsletterSubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 abonnements à la newsletter
        NewsletterSubscription::factory(10)->create();
    }
}
