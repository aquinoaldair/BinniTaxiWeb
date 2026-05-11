<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'title' => fn (): string => match (true) {
                $request->routeIs('dashboard') => 'Dashboard',
                $request->routeIs('users.index') => 'Usuarios',
                $request->routeIs('users.create') => 'Crear usuario',
                $request->routeIs('users.edit') => 'Editar usuario',
                default => 'BinniTaxi',
            },
            'auth' => [
                'user' => $request->user()?->only(['id', 'name', 'email']),
            ],
            'flash' => [
                'status' => fn (): ?string => $request->session()->get('status'),
            ],
            'navigation' => fn (): array => [
                [
                    'label' => 'Dashboard',
                    'href' => route('dashboard'),
                    'active' => $request->routeIs('dashboard'),
                    'visible' => (bool) $request->user()?->can('dashboard.view'),
                ],
                [
                    'label' => 'Usuarios',
                    'href' => route('users.index'),
                    'active' => $request->routeIs('users.*'),
                    'visible' => (bool) $request->user()?->can('users.view'),
                ],
            ],
            'logoutUrl' => fn (): ?string => $request->user() ? route('logout') : null,
        ];
    }
}
