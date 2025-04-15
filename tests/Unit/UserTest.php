<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_peut_avoir_un_service_provider_associe()
    {
        // Crée un utilisateur et associe-lui un ServiceProvider via la factory
        $user = User::factory()->create();
        // Suppose que la relation est définie dans le modèle User (hasOne ServiceProvider)
        $serviceProvider = \App\Models\ServiceProvider::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertNotNull($user->serviceProvider);
        $this->assertEquals($serviceProvider->id, $user->serviceProvider->id);
    }
}
