<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Features;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');
        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        // Désactive temporairement le middleware de vérification d'e-mail pour ce test.
        $this->withoutMiddleware(\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class);

        $response = $this->post('/register', [
            'firstname'             => 'Test',
            'lastname'              => 'User',
            'email'                 => 'test@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
            'terms'                 => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        // Vérifie que l'utilisateur est maintenant authentifié
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', [], false));

        // Vérifie que l'utilisateur a bien été stocké en base
        $this->assertDatabaseHas('users', [
            'email'     => 'test@example.com',
            'firstname' => 'Test',
            'lastname'  => 'User',
        ]);
    }
}
