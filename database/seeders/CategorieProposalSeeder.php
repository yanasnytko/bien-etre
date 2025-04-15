<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategorieProposal;

class CategorieProposalSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 propositions de catégories
        CategorieProposal::factory(10)->create();
    }
}
