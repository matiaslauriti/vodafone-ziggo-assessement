<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <main class="text-white px-2">
        <header class="px-3">
            <div class="flex items-center justify-center py-6">
                <svg width="79" height="35" viewBox="0 0 79 35" xmlns="http://www.w3.org/2000/svg">
                    <path fill="white" fill-rule="evenodd" d="M25 1.68a7.27 7.27 0 0 0-5.69 7.27c5.33 1.3 7.75 4.52 7.76 8.97a9.36 9.36 0 0 1-9.43 9.34c-4.81.01-9.81-4.09-9.83-10.68-.02-4.36 2.33-8.55 5.34-11.04a17.48 17.48 0 0 1 10.59-4c.47 0 .96.04 1.26.14a17.5 17.5 0 1 1-15 31.63A17.5 17.5 0 0 1 25 1.68zM71 26.5H55.27c-1.64 0-2.53-.48-3.06-1.67-.58-1.32.16-2.62.6-3.04L63.89 11.6H56.4c-2.3-.36-3.17-2.4-3.23-4.1h13.1c1.67 0 2.62.52 3.19 1.74.7 1.51-.29 2.92-.73 3.33l-10.51 9.87h9.12c2.57.3 3.59 2.58 3.66 4.06zm-22.83-.15c0 1 .41 1.9 1.08 2.55.68.65 1.6 1.05 2.62 1.05h19.26c1.02 0 1.94-.4 2.62-1.05a3.54 3.54 0 0 0 1.08-2.55V11.22c0-1.91 1.99-3.69 4.17-3.7v18.83c0 2.11-.88 4.03-2.3 5.4A7.96 7.96 0 0 1 71.12 34H51.87a7.96 7.96 0 0 1-5.56-2.24 7.51 7.51 0 0 1-2.31-5.4V7.64c0-2.11.88-4.03 2.3-5.41A7.97 7.97 0 0 1 51.88 0h19.25a8.04 8.04 0 0 1 5.89 2.55 1.99 1.99 0 0 1 0 2.86 2.12 2.12 0 0 1-2.95 0 4.2 4.2 0 0 0-1.5-1.08 3.79 3.79 0 0 0-1.44-.28H51.87c-1.02 0-1.94.4-2.62 1.05a3.54 3.54 0 0 0-1.08 2.55v18.7z"></path>
                </svg>
                <h1 class="ml-3 text-4xl">VodafoneZiggo Assessment</h1>
            </div>
            <menu class="mb-2 flex gap-2">
                <li><Link :href="route('dashboard')">Dashboard</Link></li>
                <li><p>|</p></li>
                <li><Link :href="route('scans.index')">Scans</Link></li>
            </menu>
            <div class="h-1 bg-gradient-to-r from-red-600 to-orange-600"></div>
        </header>
        <article class="mt-3">
            <slot />
        </article>
    </main>
</template>
