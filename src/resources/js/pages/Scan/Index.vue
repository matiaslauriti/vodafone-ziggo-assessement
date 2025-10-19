<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Paginator from "@/components/Paginator.vue";
import Scan from "@/components/Scan.vue";
import { Scan as ScanType } from "@/types";

const { scans } = defineProps<{
    scans: {
        data: ScanType[];
        meta: any;
    },
}>();
</script>

<template>
    <Head title="Scan Index" />
    <h2 class="text-2xl text-center mb-6">Existing Scans</h2>

    <div class="border rounded p-2 mx-auto my-4" v-for="scan in scans.data">
        <Scan :scan="scan" />
    </div>

    <div>
        <Paginator :links="scans?.meta.links" class="mt-6" />
    </div>
</template>
