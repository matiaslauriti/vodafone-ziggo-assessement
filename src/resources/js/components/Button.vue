<script setup lang="ts">
const { disabled = false } = defineProps<{
    disabled?: boolean;
}>();
</script>

<template>
    <button class="capitalize bg-white text-black font-medium px-3 py-1 rounded-md cursor-pointer hover:bg-gray-300"
        :class="{ disabled }"
    >
        <slot />
    </button>
</template>

<style scoped>
@reference 'tailwindcss';

.disabled {
    @apply cursor-not-allowed bg-gray-500/80 text-gray-200;
}
</style>
