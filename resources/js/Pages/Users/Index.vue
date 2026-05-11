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
    <section class="rounded-xl border border-[#E5E7EB] bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-[#E5E7EB] p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <p class="text-sm font-medium text-[#2E8B57]">Usuarios</p>
                <h2 class="mt-2 text-2xl font-medium tracking-tight text-[#1F2937]">Administración de usuarios</h2>
                <p class="mt-2 text-sm leading-6 text-[#6B7280]">Gestiona accesos, roles y permisos desde una sola pantalla.</p>
            </div>

            <Link
                :href="actions.createUrl"
                class="inline-flex h-10 items-center justify-center rounded-xl bg-[#2E8B57] px-4 text-sm font-medium text-white shadow-sm transition hover:bg-[#287a4d] focus:outline-none focus:ring-4 focus:ring-[#2E8B57]/20"
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
                        <th class="px-5 py-3 text-right text-xs font-medium uppercase tracking-wide text-[#6B7280]">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB] bg-white">
                    <tr v-for="user in users.data" :key="user.id" class="transition hover:bg-[#F5F7F4]/70">
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
                        <td class="whitespace-nowrap px-5 py-4 text-sm">
                            <div class="flex justify-end gap-2">
                                <Link
                                    :href="user.editUrl"
                                    class="inline-flex h-9 items-center justify-center rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm font-medium text-[#1F2937] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#2E8B57]"
                                >
                                    Editar
                                </Link>

                                <button
                                    v-if="user.canDelete"
                                    type="button"
                                    class="inline-flex h-9 items-center justify-center rounded-xl border border-[#EF4444]/20 bg-white px-3 text-sm font-medium text-[#EF4444] shadow-sm transition hover:bg-[#EF4444]/5"
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

        <div class="flex flex-col gap-3 border-t border-[#E5E7EB] p-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-[#6B7280]">
                Mostrando
                <span class="font-medium text-[#1F2937]">{{ users.meta.from ?? 0 }}</span>
                a
                <span class="font-medium text-[#1F2937]">{{ users.meta.to ?? 0 }}</span>
                de
                <span class="font-medium text-[#1F2937]">{{ users.meta.total }}</span>
                usuarios
            </p>

            <div class="flex gap-2">
                <Link
                    v-if="users.meta.prevPageUrl"
                    :href="users.meta.prevPageUrl"
                    class="inline-flex h-9 items-center justify-center rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm font-medium text-[#1F2937] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#2E8B57]"
                >
                    Anterior
                </Link>
                <Link
                    v-if="users.meta.nextPageUrl"
                    :href="users.meta.nextPageUrl"
                    class="inline-flex h-9 items-center justify-center rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm font-medium text-[#1F2937] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#2E8B57]"
                >
                    Siguiente
                </Link>
            </div>
        </div>
    </section>
</template>
