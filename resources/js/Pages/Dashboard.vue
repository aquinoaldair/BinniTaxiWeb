<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

defineProps<{
    stats: {
        totalUsers: number;
        administratorCount: number;
        permissionCount: number;
    };
    latestUsers: Array<{
        id: number;
        name: string;
        email: string;
        roles: string[];
    }>;
    actions: {
        createUserUrl: string;
    };
}>();
</script>

<template>
    <section class="grid gap-4 md:grid-cols-3">
        <article class="stat-card relative overflow-hidden">
            <div class="metric-orb"></div>
            <p class="stat-label">Usuarios</p>
            <p class="stat-value">{{ stats.totalUsers }}</p>
            <p class="stat-help">Total de cuentas registradas</p>
        </article>

        <article class="stat-card relative overflow-hidden">
            <div class="metric-orb"></div>
            <p class="stat-label">Administradores</p>
            <p class="stat-value">{{ stats.administratorCount }}</p>
            <p class="stat-help">Usuarios con rol administrador</p>
        </article>

        <article class="stat-card relative overflow-hidden">
            <div class="metric-orb"></div>
            <p class="stat-label">Permisos</p>
            <p class="stat-value">{{ stats.permissionCount }}</p>
            <p class="stat-help">Permisos activos del sistema</p>
        </article>
    </section>

    <section class="panel mt-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="eyebrow">Actividad</p>
                <h2 class="mt-2 text-2xl font-semibold text-brand-950">Usuarios recientes</h2>
            </div>

            <Link :href="actions.createUserUrl" class="btn btn-primary">Nuevo usuario</Link>
        </div>

        <div class="table-card mt-6">
            <table class="min-w-full divide-y divide-brand-100">
                <thead class="table-head">
                    <tr>
                        <th class="px-4 py-4">Nombre</th>
                        <th class="px-4 py-4">Correo</th>
                        <th class="px-4 py-4">Roles</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 bg-white">
                    <tr v-for="user in latestUsers" :key="user.id">
                        <td class="table-cell font-semibold text-brand-950">{{ user.name }}</td>
                        <td class="table-cell">{{ user.email }}</td>
                        <td class="table-cell">
                            <div class="flex flex-wrap gap-2">
                                <span v-for="role in user.roles" :key="role" class="chip">{{ role }}</span>
                                <span v-if="user.roles.length === 0" class="text-brand-500">Sin rol</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
