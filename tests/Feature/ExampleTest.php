<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that public landing page returns HTTP 200 for unauthenticated visitors.
     */
    public function test_landing_page_returns_ok_for_guests(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Aureus', false);
        $response->assertSee('Ad Cycler', false);
        $response->assertSee('Connexion / Accès Démo', false);
    }

    /**
     * Test that unauthenticated visitors are redirected from protected dashboard to login.
     */
    public function test_guests_are_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('login');
    }

    /**
     * Test that authenticated users see dashboard links when visiting the landing page.
     */
    public function test_authenticated_user_sees_dashboard_link_on_landing_page(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Mon Dashboard', false);
        $response->assertDontSee('Connexion / Accès Démo', false);
    }
}
