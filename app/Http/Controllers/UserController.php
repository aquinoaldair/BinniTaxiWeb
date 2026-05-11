<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::query()
            ->with('roles')
            ->latest()
            ->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $this->transformUsersPaginator($users),
            'actions' => [
                'createUrl' => route('users.create'),
            ],
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Form', [
            'title' => 'Crear usuario',
            'mode' => 'create',
            'formAction' => route('users.store'),
            'formMethod' => 'POST',
            'submitLabel' => 'Guardar usuario',
            'cancelUrl' => route('users.index'),
            'roles' => $this->availableRoles(),
            'form' => [
                'name' => old('name', ''),
                'email' => old('email', ''),
                'roles' => array_map('intval', old('roles', [])),
            ],
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->safe()->except('roles'));
        $user->syncRoles($request->validated('roles', []));

        return redirect()
            ->route('users.index')
            ->with('status', 'Usuario creado correctamente.');
    }

    public function edit(User $user): Response
    {
        $user->load('roles');

        return Inertia::render('Users/Form', [
            'title' => 'Editar usuario',
            'mode' => 'edit',
            'formAction' => route('users.update', $user),
            'formMethod' => 'PUT',
            'submitLabel' => 'Guardar cambios',
            'cancelUrl' => route('users.index'),
            'roles' => $this->availableRoles(),
            'form' => [
                'name' => old('name', $user->name),
                'email' => old('email', $user->email),
                'roles' => array_map('intval', old('roles', $user->roles->pluck('id')->all())),
            ],
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if (($validated['password'] ?? null) === null) {
            unset($validated['password']);
        }

        $user->update(collect($validated)->except('roles')->all());
        $user->syncRoles($validated['roles'] ?? []);

        return redirect()
            ->route('users.index')
            ->with('status', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->is(auth()->user()), 422, 'No puedes eliminar tu propio usuario.');

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'Usuario eliminado correctamente.');
    }

    /**
     * @return list<array{id:int,name:string}>
     */
    private function availableRoles(): array
    {
        return Role::query()
            ->orderBy('name')
            ->get()
            ->map(fn (Role $role): array => [
                'id' => $role->id,
                'name' => $role->name,
            ])
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function transformUsersPaginator(LengthAwarePaginator $users): array
    {
        return [
            'data' => $users->getCollection()
                ->map(fn (User $user): array => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->pluck('name')->values()->all(),
                    'editUrl' => route('users.edit', $user),
                    'deleteUrl' => route('users.destroy', $user),
                    'canDelete' => ! $user->is(auth()->user()),
                ])
                ->all(),
            'meta' => [
                'currentPage' => $users->currentPage(),
                'lastPage' => $users->lastPage(),
                'perPage' => $users->perPage(),
                'total' => $users->total(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
                'prevPageUrl' => $users->previousPageUrl(),
                'nextPageUrl' => $users->nextPageUrl(),
            ],
        ];
    }
}
