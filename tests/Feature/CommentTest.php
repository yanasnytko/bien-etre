<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_peut_creer_un_commentaire()
    {
        // Crée un utilisateur et un prestataire
        $user = User::factory()->create();
        $serviceProvider = ServiceProvider::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comments.store'), [
            'user_id'             => $user->id,
            'service_provider_id' => $serviceProvider->id,
            'title'               => 'Super prestation',
            'content'             => 'J’ai adoré le service proposé',
            'date'                => now()->toDateTimeString(),
            'rating'              => 5,
        ]);

        $response->assertRedirect(route('comments.index'));
        $this->assertDatabaseHas('comments', ['title' => 'Super prestation']);
    }
}
