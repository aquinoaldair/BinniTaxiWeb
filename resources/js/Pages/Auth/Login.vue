<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const showPassword = ref(false);

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
    <Head title="Iniciar sesión" />

    <main class="min-h-screen bg-[#F5F7F4] text-[#1F2937]" style="font-family: Inter, ui-sans-serif, system-ui, sans-serif;">
        <div class="mx-auto grid min-h-screen w-full max-w-7xl lg:grid-cols-2">
            <section class="relative hidden overflow-hidden px-10 py-12 lg:flex lg:flex-col lg:justify-between xl:px-16">
                <div class="absolute left-16 top-24 h-48 w-48 rounded-full border border-[#2E8B57]/10" />
                <div class="absolute bottom-24 right-20 h-28 w-28 rounded-[2rem] border border-[#2E8B57]/10 rotate-12" />
                <div class="absolute right-24 top-36 h-px w-40 bg-[#2E8B57]/15" />

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2E8B57] text-sm font-medium text-white shadow-sm">
                            BT
                        </div>
                        <div>
                            <p class="text-sm font-medium tracking-tight text-[#1F2937]">BinniTaxi</p>
                            <p class="text-xs text-[#1F2937]/55">Admin Dashboard</p>
                        </div>
                    </div>

                    <div class="mt-24 max-w-xl">
                        <p class="text-sm font-medium text-[#2E8B57]">Operación administrativa</p>
                        <h1 class="mt-5 text-5xl font-medium leading-[1.04] tracking-tight text-[#1F2937] xl:text-6xl">
                            Gestiona tu operación con claridad.
                        </h1>
                        <p class="mt-6 max-w-md text-base leading-7 text-[#1F2937]/65">
                            Acceso centralizado para usuarios, permisos y gestión interna de BinniTaxi.
                        </p>
                    </div>
                </div>

                <div class="relative z-10 mb-2 max-w-lg rounded-2xl border border-[#1F2937]/10 bg-white p-5 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium tracking-tight text-[#1F2937]">Mapa operativo</p>
                            <p class="mt-1 text-xs text-[#1F2937]/55">Zonas, rutas y accesos en tiempo real</p>
                        </div>
                        <span class="rounded-full bg-[#22C55E]/10 px-3 py-1 text-xs font-medium text-[#2E8B57]">Activo</span>
                    </div>

                    <div class="relative h-64 overflow-hidden rounded-xl bg-[#F5F7F4]">
                        <div class="absolute left-8 top-8 h-20 w-20 rounded-full border border-[#2E8B57]/15" />
                        <div class="absolute bottom-8 right-10 h-24 w-24 rounded-full border border-[#2E8B57]/15" />
                        <div class="absolute left-0 top-1/2 h-px w-full bg-[#1F2937]/10" />
                        <div class="absolute left-1/2 top-0 h-full w-px bg-[#1F2937]/10" />
                        <div class="absolute left-12 top-14 h-2.5 w-2.5 rounded-full bg-[#2E8B57]" />
                        <div class="absolute right-16 top-20 h-2.5 w-2.5 rounded-full bg-[#22C55E]" />
                        <div class="absolute bottom-16 left-1/3 h-2.5 w-2.5 rounded-full bg-[#2E8B57]" />
                        <svg class="absolute inset-0 h-full w-full text-[#2E8B57]/45" viewBox="0 0 420 260" fill="none" aria-hidden="true">
                            <path d="M52 58C96 78 111 132 162 132C214 132 218 80 268 88C317 96 332 152 374 168" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="8 8" />
                            <path d="M92 202C132 162 174 184 210 154C248 122 269 132 324 116" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <div class="absolute left-1/2 top-1/2 flex -translate-x-1/2 -translate-y-1/2 items-center gap-2 rounded-full border border-[#1F2937]/10 bg-white px-4 py-2 text-sm font-medium tracking-tight text-[#1F2937] shadow-sm">
                            <svg class="h-4 w-4 text-[#2E8B57]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M6 17.5 8.5 6h7L18 17.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.25 14h9.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M6.5 18.5h.01M17.5 18.5h.01" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                            </svg>
                            Movilidad conectada
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex min-h-screen items-center justify-center px-5 py-10 sm:px-8 lg:px-12">
                <div class="w-full max-w-md">
                    <div class="mb-10 flex items-center gap-3 lg:hidden">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#2E8B57] text-sm font-medium text-white shadow-sm">
                            BT
                        </div>
                        <div>
                            <p class="text-sm font-medium tracking-tight text-[#1F2937]">BinniTaxi</p>
                            <p class="text-xs text-[#1F2937]/55">Admin Dashboard</p>
                        </div>
                    </div>

                    <div class="rounded-xl border border-[#1F2937]/10 bg-white p-6 shadow-sm sm:p-8">
                        <div class="mb-8">
                            <p class="text-sm font-medium text-[#2E8B57]">Acceso seguro</p>
                            <h2 class="mt-3 text-3xl font-medium tracking-tight text-[#1F2937]">
                                Bienvenido de nuevo
                            </h2>
                            <p class="mt-3 text-sm leading-6 text-[#1F2937]/60">
                                Ingresa tus credenciales para continuar al panel administrativo.
                            </p>
                        </div>

                        <form class="space-y-5" @submit.prevent="submit">
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium tracking-tight text-[#1F2937]">
                                    Correo electrónico
                                </label>
                                <div
                                    class="flex h-12 items-center gap-3 rounded-xl border bg-white px-3 shadow-sm transition focus-within:border-[#2E8B57] focus-within:ring-4 focus-within:ring-[#2E8B57]/10"
                                    :class="form.errors.email ? 'border-red-300' : 'border-[#1F2937]/10'"
                                >
                                    <svg class="h-4 w-4 shrink-0 text-[#1F2937]/45" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4 6.75A2.75 2.75 0 0 1 6.75 4h10.5A2.75 2.75 0 0 1 20 6.75v10.5A2.75 2.75 0 0 1 17.25 20H6.75A2.75 2.75 0 0 1 4 17.25V6.75Z" stroke="currentColor" stroke-width="1.8" />
                                        <path d="m6.5 8 4.07 3.13a2.35 2.35 0 0 0 2.86 0L17.5 8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                    </svg>
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        required
                                        autofocus
                                        autocomplete="email"
                                        placeholder="admin@binnitaxi.com"
                                        class="h-full min-w-0 flex-1 border-0 bg-transparent text-sm text-[#1F2937] outline-none placeholder:text-[#1F2937]/35"
                                        :aria-invalid="Boolean(form.errors.email)"
                                        :aria-describedby="form.errors.email ? 'email-error' : undefined"
                                    >
                                </div>
                                <p v-if="form.errors.email" id="email-error" class="text-sm font-medium text-red-600">
                                    {{ form.errors.email }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center justify-between gap-4">
                                    <label for="password" class="block text-sm font-medium tracking-tight text-[#1F2937]">
                                        Contraseña
                                    </label>
                                    <Link href="/forgot-password" class="text-sm font-medium text-[#2E8B57] transition hover:text-[#1F2937]">
                                        Recuperar contraseña
                                    </Link>
                                </div>
                                <div
                                    class="flex h-12 items-center gap-3 rounded-xl border bg-white px-3 shadow-sm transition focus-within:border-[#2E8B57] focus-within:ring-4 focus-within:ring-[#2E8B57]/10"
                                    :class="form.errors.password ? 'border-red-300' : 'border-[#1F2937]/10'"
                                >
                                    <svg class="h-4 w-4 shrink-0 text-[#1F2937]/45" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M7.25 10.5V8.25a4.75 4.75 0 0 1 9.5 0v2.25" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                        <path d="M6.75 10.5h10.5A2.25 2.25 0 0 1 19.5 12.75v4.5a2.25 2.25 0 0 1-2.25 2.25H6.75a2.25 2.25 0 0 1-2.25-2.25v-4.5a2.25 2.25 0 0 1 2.25-2.25Z" stroke="currentColor" stroke-width="1.8" />
                                    </svg>
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        :type="showPassword ? 'text' : 'password'"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Ingresa tu contraseña"
                                        class="h-full min-w-0 flex-1 border-0 bg-transparent text-sm text-[#1F2937] outline-none placeholder:text-[#1F2937]/35"
                                        :aria-invalid="Boolean(form.errors.password)"
                                        :aria-describedby="form.errors.password ? 'password-error' : undefined"
                                    >
                                    <button
                                        type="button"
                                        class="rounded-lg p-1.5 text-[#1F2937]/45 transition hover:bg-[#F5F7F4] hover:text-[#1F2937] focus:outline-none focus:ring-2 focus:ring-[#2E8B57]/20"
                                        :aria-label="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                                        @click="showPassword = !showPassword"
                                    >
                                        <svg v-if="showPassword" class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M10.58 10.58A2 2 0 0 0 13.42 13.42" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M9.88 5.08A9.5 9.5 0 0 1 12 4.85c4.45 0 7.35 3.15 8.75 5.15a3.42 3.42 0 0 1 0 4c-.43.61-.98 1.28-1.65 1.93" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                            <path d="M6.6 6.75A14.45 14.45 0 0 0 3.25 10a3.42 3.42 0 0 0 0 4C4.65 16 7.55 19.15 12 19.15c1.08 0 2.07-.19 2.96-.51" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                        </svg>
                                        <svg v-else class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M3.25 10a3.42 3.42 0 0 0 0 4C4.65 16 7.55 19.15 12 19.15S19.35 16 20.75 14a3.42 3.42 0 0 0 0-4C19.35 8 16.45 4.85 12 4.85S4.65 8 3.25 10Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 14.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" stroke="currentColor" stroke-width="1.8" />
                                        </svg>
                                    </button>
                                </div>
                                <p v-if="form.errors.password" id="password-error" class="text-sm font-medium text-red-600">
                                    {{ form.errors.password }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <label class="inline-flex cursor-pointer items-center gap-2.5 text-sm font-medium text-[#1F2937]/75">
                                    <input
                                        v-model="form.remember"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-[#1F2937]/20 text-[#2E8B57] focus:ring-2 focus:ring-[#2E8B57]/20"
                                    >
                                    Recordarme
                                </label>
                            </div>

                            <button
                                type="submit"
                                class="flex h-12 w-full items-center justify-center rounded-xl bg-[#2E8B57] px-4 text-sm font-medium text-white shadow-sm transition hover:bg-[#287a4d] focus:outline-none focus:ring-4 focus:ring-[#2E8B57]/20 disabled:cursor-not-allowed disabled:opacity-70"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-white/35 border-t-white" />
                                {{ form.processing ? 'Iniciando...' : 'Iniciar sesión' }}
                            </button>
                        </form>
                    </div>

                    <p class="mt-6 text-center text-xs leading-5 text-[#1F2937]/50">
                        Acceso exclusivo para personal autorizado de BinniTaxi.
                    </p>
                </div>
            </section>
        </div>
    </main>
</template>
