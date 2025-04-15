<?php

namespace Tests\Feature;

use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_authentifie_peut_acceder_a_la_page_des_prestataires()
    {
        // Crée un utilisateur via la factory
        $user = User::factory()->create();
        // Authentifie cet utilisateur
        $this->actingAs($user);

        // Crée quelques prestataires
        ServiceProvider::factory(3)->create();

        // Effectue une requête GET sur la route index
        $response = $this->get(route('service-providers.index'));

        $response->assertStatus(200);
        $response->assertSee('Liste des Prestataires'); // Ce texte doit être présent dans la vue index
    }

    /** @test */
    public function seul_le_proprietaire_peut_mettre_a_jour_un_service_provider()
    {
        // Crée le propriétaire et un autre utilisateur
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        // Crée un prestataire associé au propriétaire avec tous les champs requis par la validation
        $serviceProvider = ServiceProvider::factory()->create([
            'user_id'        => $owner->id,
            'company_name'   => 'Nom Initial',
            'company_email'  => 'initial@example.com',
            'website'        => 'http://example.com',
            'telephone'      => '1234567890',
            'vat_number'     => '1234567890',
        ]);

        // Test en tant qu'utilisateur non propriétaire
        $this->actingAs($otherUser);
        $response = $this->patch(route('service-providers.update', $serviceProvider->id), [
            'company_name'  => 'Nom Modifié',
            'company_email' => 'modifie@example.com',
            'website'       => 'http://modified.com',
            'telephone'     => '0987654321',
            'vat_number'    => '0987654321',
        ]);
        // Le test attend que la policy bloque l'accès, donc on s'attend à un 403
        $response->assertStatus(403);

        // Test en tant que propriétaire
        $this->actingAs($owner);
        $response = $this->patch(route('service-providers.update', $serviceProvider->id), [
            'company_name'  => 'Nom Modifié',
            'company_email' => 'modifie@example.com',
            'website'       => 'http://modified.com',
            'telephone'     => '0987654321',
            'vat_number'    => '0987654321',
        ]);
        // Selon la configuration de ton contrôleur, la redirection peut être 302
        $response->assertRedirect(route('service-providers.index'));
        $this->assertDatabaseHas('service_providers', [
            'id'           => $serviceProvider->id,
            'company_name' => 'Nom Modifié'
        ]);
    }
}
