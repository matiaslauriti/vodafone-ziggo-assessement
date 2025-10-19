<script setup lang="ts">
import {Head, router, usePage} from '@inertiajs/vue3';
import Button from "@/components/Button.vue";
import Paginator from "@/components/Paginator.vue";
import Scan from "@/components/Scan.vue";
import { type Scan as ScanType } from "@/types";
import { type Ref, ref } from "vue";
import { route } from "ziggy-js";

const { scans } = defineProps<{
    scans: {
        data: ScanType[];
        meta: any;
    },
}>();

const scanning: Ref<boolean> = ref(true);

function startScan() {
    if (!scanning.value) {
        fetch(
            route('scans.store'),
            {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': usePage().props.csrf_token as string,
                }
            },
        )
            .then(() => { scanning.value = true; })
            .catch(() => alert('An error occurred.'));
    }
}

function checkIfScanning() {
    fetch(route('scans.in-progress'))
        .then((response) => response.json())
        .then(({ in_progress }) => {
            if (in_progress != scanning.value && in_progress === true) {
                router.reload();
            }

            scanning.value = in_progress;
        });
}

checkIfScanning();

setInterval(() => {
    checkIfScanning();
}, 5000);
</script>

<template>
    <Head title="Scan Index" />

    <h2 class="text-2xl text-center mb-6">Existing Scans</h2>

    <Button @click="startScan" :disabled="scanning">start scan</Button>

    <template v-if="scans.data.length">
        <div class="border rounded p-2 mx-auto my-4" v-for="scan in scans.data">
            <Scan :scan="scan" />
        </div>

        <div>
            <Paginator :links="scans.meta.links" class="mt-6" />
        </div>
    </template>
    <template v-else>
        <p class="text-center text-xl">There are no scans available!</p>
    </template>
</template>
