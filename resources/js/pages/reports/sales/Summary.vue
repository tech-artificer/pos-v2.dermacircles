<!-- resources/js/pages/reports/sales/Summary.vue -->

<script setup lang="ts">
import { watch } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import type { BreadcrumbItem, Sale, Branch } from '@/types';
import { columns } from '@/components/reports/sales/Summary/columns';
import DataTable from '@/components/reports/sales/Summary/DataTable.vue'
import DateRangePicker from '@/components/DateRangePicker.vue';
import SalesFetcher from '@/components/reports/sales/Summary/SalesFetcher.vue';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Sales', href: '/reports/sales' },
  { title: 'Summary', href: '/reports/patients/summmary' },
];

interface SalesReportData {
  sales: Sale[]
  totalSales: number
  // topProducts?: Array<{
  //   name: string
  //   sales: number
  // }>
}

const props = defineProps<{
  salesReports: SalesReportData,
  filters: {
    startDate: any;
    endDate: any;
  };
}>()


const form = useForm({
  startDate: props.filters.startDate,
  endEndate: props.filters.endDate,
});

// use a watch to react when date range changes
// watch(
//   () => [props.filters.startDate, props.filters.endDate],
//   ([form.startDate, end]) => {
//     // fetch new data (example)
//     // console.log('Date range changed:', start, end);
//     // router.get(route('reports.sales.summary'), { start_date: start, end_date: end }, { preserveState: true, replace: true })
//   }
// )

</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <Head title="Sales Summary Report" />

    <div class="flex h-full flex-1 flex-col bg-white gap-4">
      <!-- {{ salesReports.sales }} -->
       <!-- <div class="flex flex-row items-center">
        <div class=""> -->
          <SalesFetcher :start="form.startDate" :end="form.endEndate" />
          <!-- <DateRangePicker v-model:start="filters.start_date" v-model:end="filters.end_date" class="max-w-[300px]" /> -->
        <!-- </div>
      </div> -->
      
      <DataTable :data="salesReports.sales" :columns="columns" />
    </div>
  </AppLayout>
</template>