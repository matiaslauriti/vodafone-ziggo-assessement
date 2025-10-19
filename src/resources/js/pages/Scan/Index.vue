<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Paginator from "@/components/Paginator.vue";

const { scans } = defineProps<{
    scans: Record<any, any>,
}>();

debugger;
</script>

<template>
    <Head title="Scan Index" />
    <h2 class="text-2xl text-center mb-6">Existing Scans</h2>

    <div class="border rounded p-2 mx-auto my-4 overflow-x-auto" v-for="scan in scans.data">
        <p>Scan: #{{ scan.id }}</p>
        <hr class="mt-2 mb-3">
        <table>
            <thead>
                <tr class="bg-gray-900 *:border *:border-gray-300">
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

    <div>
        <Paginator :links="scans?.meta.links" class="mt-6" />
    </div>
</template>

<style scoped>
@reference 'tailwindcss';

.fraudulent {
    @apply bg-amber-800;
}
</style>
