<script lang="ts">
export enum Variant {
    Pending = 'pending',
    InProgress = 'in-progress',
    Completed = 'completed',
    Failed = 'failed',
}
</script>

<script setup lang="ts">
const { variant = Variant.Pending } = defineProps<{
    variant?: Variant;
}>();
</script>

<template>
    <div
        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors capitalize"
        :class="variant"
    >
        <slot />
    </div>
</template>

<style scoped>
@reference 'tailwindcss'

.pending {
    @apply border-transparent bg-white text-black;
}
.in-progress {
    @apply border-transparent bg-yellow-600 text-white;
}
.completed {
    @apply border-transparent bg-green-700 text-white;
}
.failed {
    @apply border-transparent bg-red-700 text-white;
}
</style>
