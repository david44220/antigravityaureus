<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Accès Investisseur', false);
        $response->assertSee('Se Connecter', false);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('StrongPass123!'),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'StrongPass123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('StrongPass123!'),
        ]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_rate_limiting_lockout_after_five_failed_attempts(): void
    {
        $user = User::factory()->create([
            'email' => 'throttled@aureus.luxury',
            'password' => bcrypt('StrongPass123!'),
        ]);

        $throttleKey = Str::transliterate(Str::lower($user->email) . '|127.0.0.1');
        RateLimiter::clear($throttleKey);

        for ($i = 0; $i < 5; $i++) {
            $response = $this->post(route('login.store'), [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);
            $this->assertGuest();
        }

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertTrue(RateLimiter::tooManyAttempts($throttleKey, 5));
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Devenir Membre', false);
        $response->assertSee('Créer Mon Compte', false);
    }

    public function test_new_users_can_register_and_receive_wallet(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Alexander Vance',
            'email' => 'alexander@aureus.luxury',
            'password' => 'SecurP@ssw0rd!',
            'password_confirmation' => 'SecurP@ssw0rd!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));

        $user = User::where('email', 'alexander@aureus.luxury')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Alexander Vance', $user->name);

        // Verify wallet was auto-provisioned via booted hook
        $this->assertNotNull($user->wallet);
        $this->assertEquals('0.00', $user->wallet->purchase_balance);
        $this->assertEquals('0.00', $user->wallet->earnings_balance);
        $this->assertEquals(0, $user->wallet->ad_credits);
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
