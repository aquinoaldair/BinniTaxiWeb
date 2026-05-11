<script setup lang="ts">
import { h } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '../../Layouts/AuthLayout.vue';

defineOptions({
    layout: (page: unknown) => h(AuthLayout, {
        title: 'Crear administrador',
        heading: 'Crea al administrador',
        eyebrow: 'Configuración inicial',
        description: 'Este formulario solo está disponible si aún no existe ningún usuario.',
    }, () => page),
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = (): void => {
    form.post('/register', {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <form class="space-y-5" @submit.prevent="submit">
        <div>
            <label for="name" class="form-label">Nombre</label>
            <input id="name" v-model="form.name" type="text" required autofocus class="form-input">
        </div>

        <div>
            <label for="email" class="form-label">Correo</label>
            <input id="email" v-model="form.email" type="email" required class="form-input">
        </div>

        <div>
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" v-model="form.password" type="password" required class="form-input">
        </div>

        <div>
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input id="password_confirmation" v-model="form.password_confirmation" type="password" required class="form-input">
        </div>

        <button type="submit" class="btn btn-primary w-full" :disabled="form.processing">Crear administrador</button>
    </form>
</template>
