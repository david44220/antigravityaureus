<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowserShowcaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test /browser route loads with HTTP 200 and renders luxury tokens in local environment.
     */
    public function test_browser_showcase_route_returns_200_in_local_environment(): void
    {
        $this->app['env'] = 'local';

        $response = $this->get('/browser');

        $response->assertStatus(200);
        $response->assertSee('Aureus Luxury Design System & Component Atlas', false);
        $response->assertSee('Color Tokens');
        $response->assertSee('FIFO Queue Progress');
        $response->assertSee('Pure White');
        $response->assertSee('#D4AF37');
    }

    /**
     * Test /browser route strictly returns HTTP 403 when not in local environment.
     */
    public function test_browser_showcase_route_aborts_403_in_production_environment(): void
    {
        $this->app['env'] = 'production';

        $response = $this->get('/browser');

        $response->assertStatus(403);
    }

    /**
     * Test directory displays active campaigns and records impressions.
     */
    public function test_directory_traffic_exchange_renders_and_tracks_impressions(): void
    {
        $user = User::factory()->create();

        $ad = Advertisement::create([
            'user_id' => $user->id,
            'title' => 'Bespoke Private Aviation',
            'description' => 'Charter luxury private jets worldwide with verified crypto settlement.',
            'target_url' => 'https://example.com/jets',
            'type' => 'TEXT',
        ]);
        $ad->credits_allocated = 50;
        $ad->save();

        $response = $this->actingAs($user)->get('/directory');

        $response->assertStatus(200);
        $response->assertSee('Bespoke Private Aviation');

        // Verify impression was credited and credit decremented
        $ad->refresh();
        $this->assertEquals(1, $ad->impressions);
        $this->assertEquals(49, $ad->credits_allocated);
    }

    /**
     * Test clicking a directory advertisement logs telemetry and securely redirects away.
     */
    public function test_directory_click_telemetry_and_safe_redirect(): void
    {
        $user = User::factory()->create();

        $ad = Advertisement::create([
            'user_id' => $user->id,
            'title' => 'Swiss Vault Custody',
            'description' => 'Secure physical gold bullion custody.',
            'target_url' => 'https://example.com/vault',
            'type' => 'TEXT',
        ]);

        $response = $this->actingAs($user)->get("/directory/click/{$ad->id}");

        $response->assertRedirect('https://example.com/vault');

        $ad->refresh();
        $this->assertEquals(1, $ad->clicks);

        $this->assertDatabaseHas('advertisement_clicks', [
            'advertisement_id' => $ad->id,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test authenticated dashboard returns HTTP 200 with balances.
     */
    public function test_dashboard_displays_authenticated_user_portfolio(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Member Portfolio');
        $response->assertSee($user->name);
    }
}
