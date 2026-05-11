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
    <div class="admin-shell">
        <Head :title="title" />

        <div class="mx-auto flex min-h-screen max-w-7xl items-center px-4 py-8 sm:px-6 lg:px-8">
            <div class="mx-auto w-full max-w-md">
                <div class="panel">
                    <div class="mb-8">
                        <p class="eyebrow">{{ eyebrow }}</p>
                        <h1 class="mt-2 text-3xl font-semibold text-brand-950">{{ heading }}</h1>
                        <p v-if="description" class="mt-2 text-sm text-brand-700">{{ description }}</p>
                    </div>

                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
