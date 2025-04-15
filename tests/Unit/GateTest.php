<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GateTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function seul_un_utilisateur_admin_peut_voir_le_dashboard_admin()
    {
        // Création d'un utilisateur admin et d'un utilisateur non-admin
        $adminUser = User::factory()->create(['user_type' => 'admin']);
        $regularUser = User::factory()->create(['user_type' => 'user']);

        // Vérifie que la gate "view-admin-dashboard" permet l'accès à l'admin
        $this->assertTrue(Gate::forUser($adminUser)->allows('view-admin-dashboard'));
        // Vérifie que l'accès est refusé pour l'utilisateur non admin
        $this->assertFalse(Gate::forUser($regularUser)->allows('view-admin-dashboard'));
    }
}
