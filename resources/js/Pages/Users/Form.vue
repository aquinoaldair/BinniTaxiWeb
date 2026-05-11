<script setup lang="ts">
import { computed } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps<{
    title: string;
    mode: 'create' | 'edit';
    formAction: string;
    formMethod: 'POST' | 'PUT';
    submitLabel: string;
    cancelUrl: string;
    roles: Array<{
        id: number;
        name: string;
    }>;
    form: {
        name: string;
        email: string;
        roles: number[];
    };
}>();

const form = useForm({
    name: props.form.name,
    email: props.form.email,
    password: '',
    password_confirmation: '',
    roles: [...props.form.roles],
});

const passwordLabel = computed(() =>
    props.mode === 'edit' ? 'Nueva contraseña' : 'Contraseña'
);

const submit = (): void => {
    if (props.formMethod === 'PUT') {
        form.put(props.formAction);

        return;
    }

    form.post(props.formAction);
};
</script>

<template>
    <section class="rounded-xl border border-[#E5E7EB] bg-white shadow-sm">
        <div class="border-b border-[#E5E7EB] p-5 sm:p-6">
            <p class="text-sm font-medium text-[#2E8B57]">Usuarios</p>
            <h2 class="mt-2 text-2xl font-medium tracking-tight text-[#1F2937]">{{ title }}</h2>
            <p class="mt-2 text-sm leading-6 text-[#6B7280]">Define credenciales y controla los roles disponibles.</p>
        </div>

        <form class="p-5 sm:p-6" @submit.prevent="submit">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium tracking-tight text-[#1F2937]">Nombre</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        required
                        class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm text-[#1F2937] shadow-sm outline-none transition placeholder:text-[#6B7280]/60 focus:border-[#2E8B57] focus:ring-4 focus:ring-[#2E8B57]/10"
                    >
                </div>

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium tracking-tight text-[#1F2937]">Correo</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        required
                        class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm text-[#1F2937] shadow-sm outline-none transition placeholder:text-[#6B7280]/60 focus:border-[#2E8B57] focus:ring-4 focus:ring-[#2E8B57]/10"
                    >
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium tracking-tight text-[#1F2937]">{{ passwordLabel }}</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        :required="mode === 'create'"
                        class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm text-[#1F2937] shadow-sm outline-none transition placeholder:text-[#6B7280]/60 focus:border-[#2E8B57] focus:ring-4 focus:ring-[#2E8B57]/10"
                    >
                    <p v-if="mode === 'edit'" class="text-sm text-[#6B7280]">Déjala vacía si no deseas cambiarla.</p>
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium tracking-tight text-[#1F2937]">Confirmar contraseña</label>
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        :required="mode === 'create'"
                        class="h-11 w-full rounded-xl border border-[#E5E7EB] bg-white px-3 text-sm text-[#1F2937] shadow-sm outline-none transition placeholder:text-[#6B7280]/60 focus:border-[#2E8B57] focus:ring-4 focus:ring-[#2E8B57]/10"
                    >
                </div>
            </div>

            <div class="mt-8">
                <p class="text-sm font-medium tracking-tight text-[#1F2937]">Roles</p>
                <div class="mt-3 grid gap-3 md:grid-cols-2">
                    <label
                        v-for="role in roles"
                        :key="role.id"
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-[#E5E7EB] bg-[#F5F7F4]/60 px-4 py-3 text-sm font-medium text-[#1F2937] transition hover:border-[#2E8B57]/30 hover:bg-white"
                    >
                        <input
                            :id="`role-${role.id}`"
                            v-model="form.roles"
                            type="checkbox"
                            :value="role.id"
                            class="h-4 w-4 rounded border-[#E5E7EB] text-[#2E8B57] focus:ring-2 focus:ring-[#2E8B57]/20"
                        >
                        <span>{{ role.name }}</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 border-t border-[#E5E7EB] pt-6 sm:flex-row">
                <button
                    type="submit"
                    class="inline-flex h-10 items-center justify-center rounded-xl bg-[#2E8B57] px-4 text-sm font-medium text-white shadow-sm transition hover:bg-[#287a4d] focus:outline-none focus:ring-4 focus:ring-[#2E8B57]/20 disabled:cursor-not-allowed disabled:opacity-70"
                    :disabled="form.processing"
                >
                    {{ submitLabel }}
                </button>
                <Link
                    :href="cancelUrl"
                    class="inline-flex h-10 items-center justify-center rounded-xl border border-[#E5E7EB] bg-white px-4 text-sm font-medium text-[#1F2937] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#2E8B57]"
                >
                    Cancelar
                </Link>
            </div>
        </form>
    </section>
</template>
