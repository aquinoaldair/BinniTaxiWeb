<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_can_manage_users(): void
    {
        $this->seed();

        $administrator = User::query()->where('email', 'admin@binnitaxi.test')->firstOrFail();
        $this->actingAs($administrator);

        $indexResponse = $this->get(route('users.index'));
        $indexResponse->assertOk();

        $storeResponse = $this->post(route('users.store'), [
            'name' => 'Operador Demo',
            'email' => 'operador@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'roles' => [Role::findByName(RoleName::Administrator->value, 'web')->id],
        ]);

        $storeResponse->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['email' => 'operador@example.com']);

        $user = User::query()->where('email', 'operador@example.com')->firstOrFail();

        $updateResponse = $this->put(route('users.update', $user), [
            'name' => 'Operador Editado',
            'email' => 'operador.editado@example.com',
            'password' => '',
            'password_confirmation' => '',
            'roles' => [],
        ]);

        $updateResponse->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Operador Editado',
            'email' => 'operador.editado@example.com',
        ]);

        $deleteResponse = $this->delete(route('users.destroy', $user));

        $deleteResponse->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_user_without_permission_cannot_access_user_module(): void
    {
        $this->seed();

        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('users.index'))->assertForbidden();
        $this->get(route('dashboard'))->assertForbidden();
    }

    public function test_administrator_cannot_delete_own_account(): void
    {
        $this->seed();

        $administrator = User::query()->where('email', 'admin@binnitaxi.test')->firstOrFail();
        $this->actingAs($administrator);

        $this->delete(route('users.destroy', $administrator))->assertStatus(422);
    }
}
