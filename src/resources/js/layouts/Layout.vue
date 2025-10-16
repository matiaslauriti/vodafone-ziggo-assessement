<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <main class="dark:text-white px-2">
        <header class="px-3">
            <h1 class="text-4xl text-center py-6">VodafoneZiggo Assessment</h1>
            <menu class="mb-2 space-x-2">
                <Link href="/">Home</Link>
            </menu>
            <div class="h-1 bg-gradient-to-r from-red-600 to-orange-600"></div>
        </header>
        <article class="mt-3">
            <slot />
        </article>
    </main>
</template>
