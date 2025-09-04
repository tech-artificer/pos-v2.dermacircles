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
  Settings,
  Users,
} from 'lucide-vue-next';
import StatData from '@/components/reports/StatData.vue';

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
    value: '1000',
    subtitle: '50 Transactions',
    icon: Users,
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

    </div>
    </AppLayout>
</template>
