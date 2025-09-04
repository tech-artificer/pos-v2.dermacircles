<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { Patient } from '@/types'

import { columns } from '@/components/reports/patients/Diagnosis/columns';
import DataTable from '@/components/reports/patients/Diagnosis/DataTable.vue'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Patients', href: '/reports/patients' },
  { title: 'Diagnosis', href: '/reports/patients/diagnosis' },
];

const props = defineProps<{
  patients: Patient[],
  genderTags: string[],
  civilStatusTags: string[],
  sourceTags: string[]
  filters: {
    civil_status: string | null;
    gender: string | null;
    source: string | null;
  };
}>()


</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="flex h-full flex-1 flex-col bg-white gap-4">
      <!-- <DateRangePicker /> -->
      <DataTable :data="patients" :columns="columns" />
    </div>
  </AppLayout>
</template>