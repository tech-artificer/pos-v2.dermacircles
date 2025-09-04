<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { 
  Users, 

    FileText,

} from 'lucide-vue-next';
import ReportCallToAction from '@/components/reports/ReportCallToAction.vue';
import StatData from '@/components/reports/StatData.vue'
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Patients Overview', href: '/reports/patients' },
];

const props = defineProps<{
  title: string;
  description: string;
  actualPatientsCount: number,
}>();

const patientReportItems = [
  {
    title: 'Patient Demographics',
    href: route('reports.patients.demographics'),
    description:
      'Provide insights into patient demographics such as age, gender, and marital status.',

      icon: FileText,
    lastUpdated: 'Today',
    color: 'blue',
    gradient: 'from-blue-500/10 to-blue-600/5'
  },
  {
    title: 'Patient Diagnosis',
    href: route('reports.patients.diagnosis'),
    description:
      'Provides a detailed analysis of patient diagnoses, including their frequency and impact on patient outcomes.',
      icon: FileText,
    lastUpdated: 'Today',
    color: 'blue',
    gradient: 'from-blue-500/10 to-blue-600/5'
  },
]


const statistics = [
  {
    title: 'Total Patients',
    value: props.actualPatientsCount,
    subtitle: '50 Transactions',
    icon: Users,
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

      <!-- Available Reports -->
      <ReportCallToAction :report-items="patientReportItems" />
    </div>
  </AppLayout>
</template>
