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
    <div class="space-y-6">
        <section class="rounded-xl border border-[#E5E7EB] bg-white p-5 shadow-sm sm:p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-[#2E8B57]">Resumen</p>
                    <h2 class="mt-2 text-2xl font-medium tracking-tight text-[#1F2937]">
                        Estado del sistema
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-[#6B7280]">
                        Métricas principales de usuarios, administradores y permisos activos.
                    </p>
                </div>

                <Link
                    :href="actions.createUserUrl"
                    class="inline-flex h-10 items-center justify-center rounded-xl bg-[#2E8B57] px-4 text-sm font-medium text-white shadow-sm transition hover:bg-[#287a4d] focus:outline-none focus:ring-4 focus:ring-[#2E8B57]/20"
                >
                    Nuevo usuario
                </Link>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            <article class="rounded-xl border border-[#E5E7EB] bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2E8B57]/10 text-[#2E8B57]">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M16 19a4 4 0 0 0-8 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" />
                        </svg>
                    </div>
                    <span class="rounded-full bg-[#22C55E]/10 px-2.5 py-1 text-xs font-medium text-[#2E8B57]">Activo</span>
                </div>
                <p class="mt-5 text-sm font-medium text-[#6B7280]">Usuarios</p>
                <p class="mt-2 text-3xl font-medium tracking-tight text-[#1F2937]">{{ stats.totalUsers }}</p>
                <p class="mt-2 text-sm text-[#6B7280]">Total de cuentas registradas</p>
            </article>

            <article class="rounded-xl border border-[#E5E7EB] bg-white p-5 shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2E8B57]/10 text-[#2E8B57]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3.75 18.25 6v5.5c0 3.4-2.4 6.55-6.25 8.75-3.85-2.2-6.25-5.35-6.25-8.75V6L12 3.75Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        <path d="m9.75 12 1.5 1.5 3-3.25" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <p class="mt-5 text-sm font-medium text-[#6B7280]">Administradores</p>
                <p class="mt-2 text-3xl font-medium tracking-tight text-[#1F2937]">{{ stats.administratorCount }}</p>
                <p class="mt-2 text-sm text-[#6B7280]">Usuarios con rol administrador</p>
            </article>

            <article class="rounded-xl border border-[#E5E7EB] bg-white p-5 shadow-sm">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2E8B57]/10 text-[#2E8B57]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M7 8h10M7 12h10M7 16h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        <path d="M5.75 4.5h12.5A1.75 1.75 0 0 1 20 6.25v11.5a1.75 1.75 0 0 1-1.75 1.75H5.75A1.75 1.75 0 0 1 4 17.75V6.25A1.75 1.75 0 0 1 5.75 4.5Z" stroke="currentColor" stroke-width="1.8" />
                    </svg>
                </div>
                <p class="mt-5 text-sm font-medium text-[#6B7280]">Permisos</p>
                <p class="mt-2 text-3xl font-medium tracking-tight text-[#1F2937]">{{ stats.permissionCount }}</p>
                <p class="mt-2 text-sm text-[#6B7280]">Permisos activos del sistema</p>
            </article>
        </section>

        <section class="rounded-xl border border-[#E5E7EB] bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-[#E5E7EB] p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div>
                    <p class="text-sm font-medium text-[#2E8B57]">Actividad</p>
                    <h2 class="mt-1 text-xl font-medium tracking-tight text-[#1F2937]">Usuarios recientes</h2>
                </div>

                <Link
                    :href="actions.createUserUrl"
                    class="inline-flex h-10 items-center justify-center rounded-xl border border-[#E5E7EB] bg-white px-4 text-sm font-medium text-[#1F2937] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#2E8B57]"
                >
                    Crear usuario
                </Link>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#E5E7EB]">
                    <thead class="bg-[#F5F7F4]">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wide text-[#6B7280]">Nombre</th>
                            <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wide text-[#6B7280]">Correo</th>
                            <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wide text-[#6B7280]">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5E7EB] bg-white">
                        <tr v-for="user in latestUsers" :key="user.id" class="transition hover:bg-[#F5F7F4]/70">
                            <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-[#1F2937]">{{ user.name }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-[#6B7280]">{{ user.email }}</td>
                            <td class="px-5 py-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="role in user.roles" :key="role" class="rounded-full border border-[#2E8B57]/20 bg-[#2E8B57]/5 px-2.5 py-1 text-xs font-medium text-[#2E8B57]">
                                        {{ role }}
                                    </span>
                                    <span v-if="user.roles.length === 0" class="text-[#6B7280]">Sin rol</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>
