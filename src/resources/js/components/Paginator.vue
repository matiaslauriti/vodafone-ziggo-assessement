<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps<{
    links?: [
        {
            active: boolean,
            label: string,
            url: string,
        }
    ],
}>();
</script>

<template>
    <div v-if="links?.length" class="flex flex-wrap justify-center *:mr-1 *:mb-1 *:px-2 *:py-3 *:text-sm *:leading-4">
        <template v-for="(link, key) in links">
            <Link v-if="link.url !== null" :key="key" class="text-gray-400 hover:text-gray-300" :class="{ 'text-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
    </div>
</template>
