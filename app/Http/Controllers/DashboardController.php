<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleName;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
            'stats' => [
                'totalUsers' => User::query()->count(),
                'administratorCount' => User::role(RoleName::Administrator->value)->count(),
                'permissionCount' => Permission::query()->count(),
            ],
            'latestUsers' => User::query()
                ->with('roles')
                ->latest()
                ->take(5)
                ->get()
                ->map(fn (User $user): array => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->pluck('name')->values()->all(),
                ])
                ->all(),
            'actions' => [
                'createUserUrl' => route('users.create'),
            ],
        ]);
    }
}
