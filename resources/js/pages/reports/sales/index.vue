<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { Badge } from '@/components/ui/badge'
// import AppNavigation from '@/components/AppNavigation.vue';
import ReportsSelection from '@/components/reports/ReportsSelection.vue';
import { 
  Users, 
    ChartLine,
    FileText,

} from 'lucide-vue-next';

import StatData from '@/components/reports/StatData.vue'
// import Overview from '@/components/reports/patients/Overview.vue'

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Reports', href: '/reports' },
    { title: 'Sales Overview', href: '/reports/sales' },
];

const props = defineProps<{
    title: string;
    description: string;
}>();

const salestReportItems = [
    {
        title: 'Sales Summary',
        href: route('reports.sales.summary'),
        description:
            'Provide insights into patient demographics such as age, gender, and marital status.',
    },
    {
        title: 'Sales by Products and Services',
        href: route('reports.sales.products-services'),
        description:
            'Provide insights into patient demographics such as age, gender, and marital status.',
    },
    {
        title: 'Sales by Employee',
        href: route('reports.sales.employees'),
        description:
            'Provides a comprehensive overview of patient visit history, including dates, reasons for visits, and outcomes.',
    },
]

const statistics = [
  {
    title: 'Total Sales',
    value: '1000',
    subtitle: '50 Transactions',
    icon: ChartLine,
    trend: '+12%',
    trendUp: true
  },
];
</script>

<template>

    <Head :title="props.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-8">
            <!-- Page Header -->
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-foreground">Reports</h1>
                <p class="text-muted-foreground mt-2">
                Overview of your reports and analytics
                </p>
            </div>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <StatData :statistics="statistics" />
            </div>
            <div>
                <ReportsSelection title="Sales Reports" :items="salestReportItems" />
            </div>
            <!-- <Overview />    -->
        </div>
    </AppLayout>
</template>
