<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import type { PageProps } from '../types/inertia';

const page = usePage<PageProps>();
const mobileSidebarOpen = ref(false);

const visibleNavigation = computed(() =>
    page.props.navigation.filter((item) => item.visible)
);

const errorMessages = computed(() => Object.values(page.props.errors).flat());

const userInitials = computed(() => {
    const name = page.props.auth.user?.name ?? 'Admin';

    return name
        .split(' ')
        .map((part) => part[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
});

const logout = (): void => {
    if (!page.props.logoutUrl) {
        return;
    }

    router.post(page.props.logoutUrl);
};
</script>

<template>
    <div class="min-h-screen bg-[#F5F7F4] text-[#1F2937]" style="font-family: Inter, ui-sans-serif, system-ui, sans-serif;">
        <Head :title="page.props.title ?? 'BinniTaxi'" />

        <aside class="fixed inset-y-0 left-0 z-40 hidden w-72 border-r border-[#E5E7EB] bg-white lg:flex lg:flex-col">
            <div class="flex h-16 items-center gap-3 border-b border-[#E5E7EB] px-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#2E8B57] text-sm font-medium text-white shadow-sm">
                    BT
                </div>
                <div>
                    <p class="text-sm font-medium tracking-tight text-[#1F2937]">BinniTaxi</p>
                    <p class="text-xs text-[#6B7280]">Admin Dashboard</p>
                </div>
            </div>

            <nav class="flex-1 space-y-1 px-3 py-5">
                <Link
                    v-for="item in visibleNavigation"
                    :key="item.href"
                    :href="item.href"
                    :class="[
                        'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition',
                        item.active
                            ? 'bg-[#2E8B57]/10 text-[#2E8B57]'
                            : 'text-[#6B7280] hover:bg-[#F5F7F4] hover:text-[#1F2937]',
                    ]"
                >
                    <svg v-if="item.label === 'Dashboard'" class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 13h6V4H4v9ZM14 20h6v-9h-6v9ZM4 20h6v-3H4v3ZM14 7h6V4h-6v3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    <svg v-else class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M16 19a4 4 0 0 0-8 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" />
                        <path d="M20 19a3.5 3.5 0 0 0-3-3.45M4 19a3.5 3.5 0 0 1 3-3.45" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    {{ item.label }}
                </Link>
            </nav>

            <div class="border-t border-[#E5E7EB] p-4">
                <div class="flex items-center gap-3 rounded-xl border border-[#E5E7EB] bg-[#F5F7F4] p-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-xs font-medium text-[#2E8B57] shadow-sm">
                        {{ userInitials }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium tracking-tight text-[#1F2937]">{{ page.props.auth.user?.name }}</p>
                        <p class="truncate text-xs text-[#6B7280]">{{ page.props.auth.user?.email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <div
            v-if="mobileSidebarOpen"
            class="fixed inset-0 z-50 bg-[#1F2937]/30 lg:hidden"
            @click="mobileSidebarOpen = false"
        />

        <aside
            :class="[
                'fixed inset-y-0 left-0 z-50 w-72 border-r border-[#E5E7EB] bg-white transition-transform lg:hidden',
                mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full',
            ]"
        >
            <div class="flex h-16 items-center justify-between border-b border-[#E5E7EB] px-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#2E8B57] text-sm font-medium text-white shadow-sm">
                        BT
                    </div>
                    <p class="text-sm font-medium tracking-tight text-[#1F2937]">BinniTaxi</p>
                </div>

                <button
                    type="button"
                    class="rounded-xl border border-[#E5E7EB] p-2 text-[#6B7280] transition hover:bg-[#F5F7F4] hover:text-[#1F2937]"
                    aria-label="Cerrar navegación"
                    @click="mobileSidebarOpen = false"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <nav class="space-y-1 px-3 py-5">
                <Link
                    v-for="item in visibleNavigation"
                    :key="item.href"
                    :href="item.href"
                    :class="[
                        'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition',
                        item.active
                            ? 'bg-[#2E8B57]/10 text-[#2E8B57]'
                            : 'text-[#6B7280] hover:bg-[#F5F7F4] hover:text-[#1F2937]',
                    ]"
                    @click="mobileSidebarOpen = false"
                >
                    <svg v-if="item.label === 'Dashboard'" class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M4 13h6V4H4v9ZM14 20h6v-9h-6v9ZM4 20h6v-3H4v3ZM14 7h6V4h-6v3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    <svg v-else class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M16 19a4 4 0 0 0-8 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        <path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" />
                        <path d="M20 19a3.5 3.5 0 0 0-3-3.45M4 19a3.5 3.5 0 0 1 3-3.45" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    {{ item.label }}
                </Link>
            </nav>
        </aside>

        <div class="lg:pl-72">
            <header class="sticky top-0 z-30 border-b border-[#E5E7EB] bg-white/95">
                <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="rounded-xl border border-[#E5E7EB] p-2 text-[#6B7280] transition hover:bg-[#F5F7F4] hover:text-[#1F2937] lg:hidden"
                            aria-label="Abrir navegación"
                            @click="mobileSidebarOpen = true"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </button>

                        <div>
                            <p class="text-xs font-medium text-[#6B7280]">Panel administrativo</p>
                            <h1 class="text-lg font-medium tracking-tight text-[#1F2937] sm:text-xl">{{ page.props.title }}</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden items-center gap-3 rounded-xl border border-[#E5E7EB] bg-white px-3 py-2 shadow-sm sm:flex">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#2E8B57]/10 text-xs font-medium text-[#2E8B57]">
                                {{ userInitials }}
                            </div>
                            <div class="max-w-44">
                                <p class="truncate text-sm font-medium tracking-tight text-[#1F2937]">{{ page.props.auth.user?.name }}</p>
                                <p class="truncate text-xs text-[#6B7280]">{{ page.props.auth.user?.email }}</p>
                            </div>
                        </div>

                        <button
                            type="button"
                            class="rounded-xl border border-[#E5E7EB] bg-white px-3 py-2 text-sm font-medium text-[#6B7280] shadow-sm transition hover:border-[#2E8B57]/30 hover:text-[#1F2937]"
                            @click="logout"
                        >
                            Salir
                        </button>
                    </div>
                </div>
            </header>

            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div v-if="page.props.flash.status" class="mb-6 rounded-xl border border-[#2E8B57]/20 bg-[#2E8B57]/5 px-4 py-3 text-sm font-medium text-[#2E8B57]">
                    {{ page.props.flash.status }}
                </div>

                <div v-if="errorMessages.length > 0" class="mb-6 rounded-xl border border-[#EF4444]/20 bg-[#EF4444]/5 px-4 py-3 text-sm text-[#991B1B]">
                    <p class="font-medium">Hay errores por corregir.</p>
                    <ul class="mt-2 space-y-1">
                        <li v-for="error in errorMessages" :key="error">{{ error }}</li>
                    </ul>
                </div>

                <main class="mx-auto max-w-7xl">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
