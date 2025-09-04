<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { 
  FileText,
  BarChart3,
  ScrollText,
  Download,
  Clock,
  Mail,
  Settings,
} from 'lucide-vue-next';
import ReportCallToAction from '@/components/reports/ReportCallToAction.vue';
import QuickActions from '@/components/reports/QuickActions.vue';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Overview', href: '/reports' },
];

const props = defineProps<{
  title: string;
  description: string;
}>();


const reportItems = [
  {
    title: 'Patient Reports',
    href: route('reports.patients.index'),
    description: 'Comprehensive patient analytics including demographics, visit history, and treatment outcomes.',
    icon: FileText,
    lastUpdated: 'Today',
    color: 'blue',
    gradient: 'from-blue-500/10 to-blue-600/5'
  },
  {
    title: 'Sales Reports',
    href: route('reports.sales.index'),
    description: 'Revenue analysis, product performance, and financial insights for your practice.',
    icon: BarChart3,
    lastUpdated: '2 hours ago',
    color: 'green',
    gradient: 'from-green-500/10 to-green-600/5'
  },
  {
    title: 'System Logs',
    href: '/reports/logs',
    description: 'Activity logs, system performance, and audit trails for compliance and monitoring.',
    icon: ScrollText,
    lastUpdated: '30 min ago',
    color: 'amber',
    gradient: 'from-amber-500/10 to-amber-600/5'
  },
];

const quickActions = [
  {
    title: 'Export All Data',
    icon: Download,
    action: () => console.log('Export all data')
  },
  {
    title: 'Schedule Report',
    icon: Clock,
    action: () => console.log('Schedule report')
  },
  {
    title: 'Custom Report Builder',
    icon: Settings,
    action: () => console.log('Custom report builder')
  },
  {
    title: 'Email Reports',
    icon: Mail,
    action: () => console.log('Email reports')
  }
];

const navigateToReport = (href: string) => {
  router.visit(href);
};

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
      <!-- Available Reports -->
      <ReportCallToAction :report-items="reportItems" />

      <!-- Quick Actions -->
      <QuickActions :quickActions="quickActions"/>
    </div>
  </AppLayout>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  /* -webkit-line-clamp: 2; */
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>