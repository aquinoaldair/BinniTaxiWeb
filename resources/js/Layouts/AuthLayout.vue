<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{
    title: string;
    heading: string;
    eyebrow: string;
    description?: string;
}>();
</script>

<template>
    <div class="admin-shell overflow-hidden">
        <Head :title="title" />

        <div class="relative isolate min-h-screen px-4 py-8 sm:px-6 lg:px-8">
            <div class="absolute left-1/2 top-0 -z-10 h-80 w-80 -translate-x-1/2 rounded-full bg-brand-300/30 blur-3xl" />
            <div class="absolute bottom-0 right-0 -z-10 h-96 w-96 translate-x-1/3 rounded-full bg-emerald-900/10 blur-3xl" />

            <div class="mx-auto grid min-h-[calc(100vh-4rem)] max-w-6xl items-center gap-10 lg:grid-cols-[1.05fr_0.95fr]">
                <section class="hidden lg:block">
                    <div class="relative overflow-hidden rounded-[2.5rem] border border-white/60 bg-brand-950 p-10 text-white shadow-2xl shadow-brand-950/20">
                        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-brand-400/30 blur-3xl" />
                        <div class="absolute -bottom-24 left-10 h-72 w-72 rounded-full bg-white/10 blur-3xl" />

                        <div class="relative">
                            <div class="mb-16 inline-flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-semibold text-brand-50 backdrop-blur">
                                <span class="h-2.5 w-2.5 rounded-full bg-brand-300 shadow-[0_0_24px_rgba(134,207,161,0.9)]" />
                                BinniTaxi Admin
                            </div>

                            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-brand-200">Operación segura</p>
                            <h2 class="mt-4 max-w-xl text-5xl font-semibold leading-tight tracking-[-0.04em]">
                                Controla usuarios, permisos y accesos desde un solo lugar.
                            </h2>
                            <p class="mt-6 max-w-md text-base leading-7 text-brand-100/85">
                                Un acceso administrativo limpio, enfocado y preparado para trabajar sin distracciones.
                            </p>

                            <div class="mt-14 grid grid-cols-2 gap-4">
                                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                    <p class="text-3xl font-semibold">24/7</p>
                                    <p class="mt-2 text-sm text-brand-100/80">Gestión disponible</p>
                                </div>
                                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                                    <p class="text-3xl font-semibold">RBAC</p>
                                    <p class="mt-2 text-sm text-brand-100/80">Permisos por rol</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mx-auto w-full max-w-[30rem]">
                    <div class="mb-8 text-center lg:text-left">
                        <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-950 text-lg font-black text-white shadow-xl shadow-brand-950/20 lg:mx-0">
                            BT
                        </div>
                        <p class="eyebrow">{{ eyebrow }}</p>
                        <h1 class="mt-3 text-4xl font-semibold tracking-[-0.035em] text-brand-950">{{ heading }}</h1>
                        <p v-if="description" class="mt-3 text-base leading-7 text-brand-700">{{ description }}</p>
                    </div>

                    <div class="panel border-white/90 bg-white/95 shadow-2xl shadow-brand-950/10">
                        <slot />
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
