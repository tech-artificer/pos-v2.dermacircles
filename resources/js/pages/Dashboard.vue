<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import {
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription
} from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { 
  FileText,
  BarChart3,
  ScrollText,
  Download,
  Clock,
  Mail,
  Activity,
  Users,
  CircleArrowOutUpRight,
  ChartLine,
  MapPin
} from 'lucide-vue-next';
import StatData from '@/components/reports/StatData.vue';


import ReportCallToAction from '@/components/reports/ReportCallToAction.vue';
import QuickActions from '@/components/reports/QuickActions.vue';
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' },
];

const props = defineProps<{
  title: string;
  description: string;

}>();

const statistics = [
  {
    title: 'Total Patients',
    value: '₱ ********',
    subtitle: '**** Transactions',
    icon: Users,
    trend: '+12%',
    trendUp: true
  },
   {
    title: 'Daily Sales (₱)',
    value: '₱ ********',
    subtitle: '**** Transactions',
    icon: BarChart3,
    trend: '+12%',
    trendUp: true
  },
   {
    title: 'Products Sold',
    value: '₱ ********',
    subtitle: '**** Transactions',
    icon: ChartLine,
    trend: '+12%',
    trendUp: true
  },
   {
    title: 'Services Sold',
    value: '₱ ********',
    subtitle: '**** Transactions',
    icon: Activity,
    trend: '+12%',
    trendUp: true
  },
];

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
    href: '/reports/sales',
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
    title: 'Patient Demographics',
    icon: CircleArrowOutUpRight,
    action: () => console.log('Export all data')
  },
  {
    title: 'Patient Visits',
    icon: MapPin,
    action: () => console.log('patient visits')
  },
  {
    title: 'Sales Summary',
    icon: ChartLine,
    action: () => console.log('sales summary')
  },
  {
    title: 'Log Reports',
    icon: Activity,
    action: () => console.log('log reports')
  }
];

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-8">
      <!-- Page Header -->
      <div>
        <h1 class="text-3xl font-bold tracking-tight text-foreground">Dashboard</h1>
        <p class="text-muted-foreground mt-2">
          Monitor business performance and generate detailed analytics
        </p>
      </div>

      <!-- Stats Overview -->
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <StatData :statistics="statistics"  />
      </div>

      <!-- <ReportCallToAction :report-items="reportItems" /> -->

      <!-- Quick Actions -->
      <QuickActions :quickActions="quickActions"/>

    </div>
    </AppLayout>
</template>
