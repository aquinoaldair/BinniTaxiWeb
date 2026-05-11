<script setup lang="ts">
import { h } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue';

defineOptions({
    layout: (page: unknown) => h(AuthLayout, {
        title: 'Iniciar sesión',
        heading: 'Inicia sesión',
        eyebrow: 'Administración',
        description: 'Accede al módulo de usuarios y permisos.',
    }, () => page),
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = (): void => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <form class="space-y-5" @submit.prevent="submit">
        <div>
            <label for="email" class="form-label">Correo</label>
            <input id="email" v-model="form.email" type="email" required autofocus class="form-input">
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between">
                <label for="password" class="form-label">Contraseña</label>
                <Link href="/forgot-password" class="text-sm font-medium text-brand-700 hover:text-brand-900">¿La olvidaste?</Link>
            </div>
            <input id="password" v-model="form.password" type="password" required class="form-input">
        </div>

        <label class="flex items-center gap-3 text-sm text-brand-800">
            <input v-model="form.remember" type="checkbox" class="h-4 w-4 rounded border-brand-300 text-brand-600 focus:ring-brand-500">
            Recordarme
        </label>

        <button type="submit" class="btn btn-primary w-full" :disabled="form.processing">Entrar</button>
    </form>
</template>
