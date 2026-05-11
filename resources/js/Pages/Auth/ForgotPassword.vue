<script setup lang="ts">
import { h } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue';

defineOptions({
    layout: (page: unknown) => h(AuthLayout, {
        title: 'Recuperar contraseña',
        heading: 'Restablece tu contraseña',
        eyebrow: 'Recuperación',
        description: 'Te enviaremos un enlace si el correo existe en el sistema.',
    }, () => page),
});

const form = useForm({
    email: '',
});

const submit = (): void => {
    form.post('/forgot-password');
};
</script>

<template>
    <form class="space-y-5" @submit.prevent="submit">
        <div>
            <label for="email" class="form-label">Correo</label>
            <input id="email" v-model="form.email" type="email" required autofocus class="form-input">
        </div>

        <button type="submit" class="btn btn-primary w-full" :disabled="form.processing">Enviar enlace</button>
    </form>
</template>
