<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_first_user_can_register_and_receives_administrator_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Admin Inicial',
            'email' => 'admin@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertTrue(User::query()->firstOrFail()->hasRole(RoleName::Administrator->value));
    }

    public function test_registered_user_can_log_in_and_log_out(): void
    {
        $this->seed();

        $response = $this->post('/login', [
            'email' => 'admin@binnitaxi.test',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        $logoutResponse = $this->post('/logout');

        $logoutResponse->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_registration_is_not_available_after_users_exist(): void
    {
        $this->seed();

        $this->get('/register')->assertNotFound();
        $this->post('/register', [
            'name' => 'Otro',
            'email' => 'otro@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ])->assertForbidden();
    }
}
