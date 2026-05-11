<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect(PermissionName::cases())
            ->map(fn (PermissionName $permission): Permission => Permission::findOrCreate($permission->value, 'web'));

        $administratorRole = Role::findOrCreate(RoleName::Administrator->value, 'web');
        $administratorRole->syncPermissions($permissions);

        $administrator = User::query()->firstOrCreate(
            ['email' => 'admin@binnitaxi.test'],
            [
                'name' => 'Administrador',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        $administrator->syncRoles([$administratorRole]);
    }
}
