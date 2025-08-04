<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch, computed, onMounted } from 'vue';
import { debounce } from 'lodash';

// Define props received from Laravel Controller
const props = defineProps<{
    startDate: string;
    endDate: string;
    sales: {
        data: any[];
        links: any[]; // Pagination links
        current_page: number;
        last_page: number;
        from: number;
        to: number;
        total: number;
    };
    filters: {
        start_date: string;
        end_date: string;
        branch_id: string | null;
    };
    totalSalesAmount: string;
    totalItemsSold: number;
    branches: { branch_id: number; branch_name: string }[]
    ;
}>();

// Reactive form for filters
const form = ref({
    start_date: props.filters.start_date || new Date().toISOString().slice(0, 10),
    end_date: props.filters.end_date || new Date().toISOString().slice(0, 10),
    branch_id: props.filters.branch_id || null,
});

// Watch for filter changes and trigger a visit (debounce for performance)
watch(form.value, debounce(() => {
    router.get(route('reports.sales.summary'), form.value, {
        preserveState: true,
        replace: true, // Replace history entry
    });
}, 300)); // 300ms debounce

// Pagination function
const goToPage = (url: string) => {
    router.get(url, form.value, { preserveState: true });
};

// Current Branch Name for display
const currentBranchName = computed(() => {
    if (!form.value.branch_id) return 'All Branches';
    const branch = props.branches.find((branch: any) => branch.branch_id === form.value.branch_id);

    return branch?.branch_name
});

onMounted(() => {
    console.log(props.branches);
})
</script>

<template>

    <Head title="Daily Sales Report" />
    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">


            <div class="bg-white overflow-hidden">
                <div class="flex items-center space-x-4 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" v-model="form.start_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" v-model="form.end_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                        <select id="branch_id" v-model="form.branch_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option :value="null">All Branches</option>
                            <option v-for="branch in branches" :key="branch.branch_id" :value="branch.branch_id">
                                {{ branch.branch_name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-lg font-semibold">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        Total Sales Amount ({{ currentBranchName }}): ${{ totalSalesAmount }}
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        Total Items Sold ({{ currentBranchName }}): {{ totalItemsSold }} items
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sales ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Patient</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Amount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Discount</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Method</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Processed By</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Branch</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-if="sales.data.length === 0">
                                <td colspan="8" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                    No sales data available for the selected period.
                                </td>
                            </tr>
                            <tr v-for="sale in sales.data" :key="sale.sales_id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ new
                                    Date(sale.created_at).toLocaleDateString() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.sales_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ sale.patient?.first_name }} {{ sale.patient?.last_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.total_amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.discount_amount }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.payment_method }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.created_by?.branch_name
                                    }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ sale.branch?.branch_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="sales.links.length > 3" class="mt-4 flex justify-between items-center">
                    <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
                        <Link v-for="(link, key) in sales.links" :key="key" :href="link.url"
                            @click.prevent="goToPage(link.url)" v-html="link.label"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="{
                                'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active,
                                'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                                'rounded-l-md': key === 0,
                                'rounded-r-md': key === sales.links.length - 1,
                            }">
                        </Link>
                    </nav>
                    <div class="text-sm text-gray-700">
                        Showing {{ sales.from }} to {{ sales.to }} of {{ sales.total }} results
                    </div>
                </div>
            </div>



        </div>
    </AppLayout>
    <!-- <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daily Sales Report
            </h2>
        </template>


</AuthenticatedLayout> -->
</template>