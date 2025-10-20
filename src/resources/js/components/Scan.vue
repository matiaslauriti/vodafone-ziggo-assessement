<script setup lang="ts">
import Completed from "@/components/Badges/Completed.vue";
import Failed from "@/components/Badges/Failed.vue";
import InProgress from "@/components/Badges/InProgress.vue";
import Pending from "@/components/Badges/Pending.vue";
import { type Scan } from "@/types";

defineProps<{
    scan: Scan;
}>();
</script>

<template>
    <div class="flex justify-between items-center px-1">
        <p>Scan: #{{ scan.id }} | Started at: {{ scan.started_at }} - Finished at: {{ scan.finished_at }}</p>

        <Pending v-if="scan.status === 'pending'" />
        <InProgress v-else-if="scan.status === 'in-progress'" />
        <Completed v-else-if="scan.status === 'completed'" />
        <Failed v-else-if="scan.status === 'failed'" />
    </div>

    <template v-if="scan.status === 'in-progress' || scan.status === 'completed'">
        <hr class="mt-2 mb-3">
        <div class="overflow-x-auto">
            <table class="mx-auto">
                <thead>
                    <tr class="bg-gray-900 *:border *:border-gray-300">
                        <th>ID</th>
                        <th>External Customer ID</th>
                        <th>Error Message</th>
                        <th>BSN</th>
                        <th>IBAN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Phone Number</th>
                        <th>Street</th>
                        <th>Postcode</th>
                        <th>City</th>
                        <th>Products</th>
                        <th>Tag</th>
                        <th>IP Address</th>
                        <th>Last Invoice At</th>
                        <th>Last Login At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in scan.customers" class="even:bg-gray-800 odd:bg-gray-700 *:border *:border-gray-300" :class="{ 'fraudulent': customer.fraudulent }">
                        <td>{{ customer.id }}</td>
                        <td>{{ customer.external_customer_id }}</td>
                        <td>{{ customer.error_message }}</td>
                        <td>{{ customer.bsn }}</td>
                        <td>{{ customer.iban }}</td>
                        <td>{{ customer.first_name }}</td>
                        <td>{{ customer.last_name }}</td>
                        <td>{{ customer.date_of_birth }}</td>
                        <td>{{ customer.phone_number }}</td>
                        <td>{{ customer.street }}</td>
                        <td>{{ customer.postal_code }}</td>
                        <td>{{ customer.city }}</td>
                        <td>{{ customer.products.join(', ') }}</td>
                        <td>{{ customer.tag }}</td>
                        <td>{{ customer.ip_address }}</td>
                        <td>{{ customer.last_invoice_at }}</td>
                        <td>{{ customer.last_login_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>
</template>

<style scoped>
@reference 'tailwindcss';

.fraudulent {
    @apply bg-amber-800;
}
</style>
