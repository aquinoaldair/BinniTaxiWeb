<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

defineProps<{
    users: {
        data: Array<{
            id: number;
            name: string;
            email: string;
            roles: string[];
            editUrl: string;
            deleteUrl: string;
            canDelete: boolean;
        }>;
        meta: {
            currentPage: number;
            lastPage: number;
            perPage: number;
            total: number;
            from: number | null;
            to: number | null;
            prevPageUrl: string | null;
            nextPageUrl: string | null;
        };
    };
    actions: {
        createUrl: string;
    };
}>();

const destroyUser = (deleteUrl: string): void => {
    router.delete(deleteUrl);
};
</script>

<template>
    <section class="panel">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="eyebrow">Módulo</p>
                <h2 class="mt-2 text-2xl font-semibold text-brand-950">Administración de usuarios</h2>
                <p class="mt-2 text-sm text-brand-700">Gestiona accesos, roles y permisos desde una sola pantalla.</p>
            </div>

            <Link :href="actions.createUrl" class="btn btn-primary">Crear usuario</Link>
        </div>

        <div class="table-card mt-6">
            <table class="min-w-full divide-y divide-brand-100">
                <thead class="table-head">
                    <tr>
                        <th class="px-4 py-4">Nombre</th>
                        <th class="px-4 py-4">Correo</th>
                        <th class="px-4 py-4">Roles</th>
                        <th class="px-4 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100 bg-white">
                    <tr v-for="user in users.data" :key="user.id">
                        <td class="table-cell font-semibold text-brand-950">{{ user.name }}</td>
                        <td class="table-cell">{{ user.email }}</td>
                        <td class="table-cell">
                            <div class="flex flex-wrap gap-2">
                                <span v-for="role in user.roles" :key="role" class="chip">{{ role }}</span>
                                <span v-if="user.roles.length === 0" class="text-brand-500">Sin rol</span>
                            </div>
                        </td>
                        <td class="table-cell">
                            <div class="flex justify-end gap-2">
                                <Link :href="user.editUrl" class="btn btn-secondary">Editar</Link>

                                <button
                                    v-if="user.canDelete"
                                    type="button"
                                    class="btn btn-danger"
                                    @click="destroyUser(user.deleteUrl)"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-brand-700">
                Mostrando
                <span class="font-semibold text-brand-950">{{ users.meta.from ?? 0 }}</span>
                a
                <span class="font-semibold text-brand-950">{{ users.meta.to ?? 0 }}</span>
                de
                <span class="font-semibold text-brand-950">{{ users.meta.total }}</span>
                usuarios
            </p>

            <div class="flex gap-2">
                <Link
                    v-if="users.meta.prevPageUrl"
                    :href="users.meta.prevPageUrl"
                    class="btn btn-secondary"
                >
                    Anterior
                </Link>
                <Link
                    v-if="users.meta.nextPageUrl"
                    :href="users.meta.nextPageUrl"
                    class="btn btn-secondary"
                >
                    Siguiente
                </Link>
            </div>
        </div>
    </section>
</template>
