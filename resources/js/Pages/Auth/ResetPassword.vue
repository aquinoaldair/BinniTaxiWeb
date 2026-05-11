<script setup lang="ts">
import { h } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue';

const props = defineProps<{
    token: string;
    email: string;
}>();

defineOptions({
    layout: (page: unknown) => h(AuthLayout, {
        title: 'Nueva contraseña',
        heading: 'Define una contraseña nueva',
        eyebrow: 'Seguridad',
    }, () => page),
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = (): void => {
    form.post('/reset-password', {
        onFinish: () => form.reset('password', 'password_confirmation'),
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
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" v-model="form.password" type="password" required class="form-input">
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input id="password_confirmation" v-model="form.password_confirmation" type="password" required class="form-input">
        </div>

        <button type="submit" class="btn btn-primary w-full" :disabled="form.processing">Guardar contraseña</button>
    </form>
</template>
