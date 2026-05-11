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
    <section class="panel">
        <div class="mb-8">
            <p class="eyebrow">Usuarios</p>
            <h2 class="mt-2 text-2xl font-semibold text-brand-950">{{ title }}</h2>
            <p class="mt-2 text-sm text-brand-700">Define credenciales y controla los roles disponibles.</p>
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="form-label">Nombre</label>
                    <input id="name" v-model="form.name" type="text" required class="form-input">
                </div>

                <div>
                    <label for="email" class="form-label">Correo</label>
                    <input id="email" v-model="form.email" type="email" required class="form-input">
                </div>

                <div>
                    <label for="password" class="form-label">{{ passwordLabel }}</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        :required="mode === 'create'"
                        class="form-input"
                    >
                    <p v-if="mode === 'edit'" class="input-hint">Déjala vacía si no deseas cambiarla.</p>
                </div>

                <div>
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        :required="mode === 'create'"
                        class="form-input"
                    >
                </div>
            </div>

            <div class="mt-8">
                <p class="form-label">Roles</p>
                <div class="grid gap-3 md:grid-cols-2">
                    <label
                        v-for="role in roles"
                        :key="role.id"
                        class="flex items-center gap-3 rounded-2xl border border-brand-100 bg-brand-50/70 px-4 py-3 text-sm text-brand-800"
                    >
                        <input
                            :id="`role-${role.id}`"
                            v-model="form.roles"
                            type="checkbox"
                            :value="role.id"
                            class="h-4 w-4 rounded border-brand-300 text-brand-600 focus:ring-brand-500"
                        >
                        <span>{{ role.name }}</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <button type="submit" class="btn btn-primary" :disabled="form.processing">{{ submitLabel }}</button>
                <Link :href="cancelUrl" class="btn btn-secondary">Cancelar</Link>
            </div>
        </form>
    </section>
</template>
