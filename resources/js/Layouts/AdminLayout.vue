<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import type { PageProps } from '../types/inertia';

const page = usePage<PageProps>();

const visibleNavigation = computed(() =>
    page.props.navigation.filter((item) => item.visible)
);

const errorMessages = computed(() => Object.values(page.props.errors).flat());

const logout = (): void => {
    if (!page.props.logoutUrl) {
        return;
    }

    router.post(page.props.logoutUrl);
};
</script>

<template>
    <div class="admin-shell">
        <Head :title="page.props.title ?? 'BinniTaxi'" />

        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-6 sm:px-6 lg:px-8">
            <header class="mb-6 rounded-[2rem] border border-white/70 bg-white/80 p-5 shadow-xl shadow-brand-950/5 backdrop-blur">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="eyebrow">BinniTaxi</p>
                        <h1 class="mt-2 text-3xl font-semibold text-brand-950">{{ page.props.title }}</h1>
                    </div>

                    <div class="flex flex-col gap-4 lg:items-end">
                        <nav class="flex flex-wrap gap-2">
                            <Link
                                v-for="item in visibleNavigation"
                                :key="item.href"
                                :href="item.href"
                                :class="['nav-link', item.active ? 'nav-link-active' : '']"
                            >
                                {{ item.label }}
                            </Link>
                        </nav>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="rounded-full bg-brand-50 px-4 py-2 text-sm text-brand-700">
                                <span class="font-semibold text-brand-900">{{ page.props.auth.user?.name }}</span>
                                <span class="mx-2 text-brand-300">•</span>
                                <span>{{ page.props.auth.user?.email }}</span>
                            </div>

                            <button type="button" class="btn btn-secondary" @click="logout">Salir</button>
                        </div>
                    </div>
                </div>
            </header>

            <div v-if="page.props.flash.status" class="alert alert-success mb-6">
                {{ page.props.flash.status }}
            </div>

            <div v-if="errorMessages.length > 0" class="alert alert-danger mb-6">
                <p class="font-semibold">Hay errores por corregir.</p>
                <ul class="mt-2 space-y-1">
                    <li v-for="error in errorMessages" :key="error">{{ error }}</li>
                </ul>
            </div>

            <main class="flex-1">
                <slot />
            </main>
        </div>
    </div>
</template>
