<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import AppTable from '@/components/datatable/AppTable.vue';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { getSalesColumns } from '@/pages/reports/sales/sales-columns';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Reports',
        href: '/reports',
    },
    {
        title: 'Sales',
        href: '/sales',
    },
];

interface SalesReport {
    id: number;
    date: Date;
    client: Object;
    particulars: string;
    doctor: Object;
    facialist: Object;
    category: Object;
    amount: number;
    quantity: number;
    price: number;

}

defineProps<{
    title: string;
    description: string;
    sales: SalesReport[];
}>();

const columns = getSalesColumns();

</script>

<template>
    <Head :title="title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                 <AppTable :rows="sales" :columns="columns" class="p-4" />
            </div>
        </div>
    </AppLayout>
</template>
