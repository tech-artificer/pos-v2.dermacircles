<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import type { BreadcrumbItem } from '@/types';
// import SelectReports from './reports/SelectReports.vue';
import SelectDropdown from '@/components/SelectDropdown.vue';
import Button from '@/components/ui/button/Button.vue';
import { router } from '@inertiajs/vue3';
// import { Branch } from '@/types/models';
import AppNavigation from '@/components/AppNavigation.vue';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
];

const props = defineProps<{
  title: string;
  description: string;
  branches: Object[];
}>();

// Reactive branches array (will mutate isChecked)
// const branches = ref<Branch[]>(props.branches);

// Example Reports List
const reports = [
  {
    // id: 1,
    name: 'Sales Report',
    route: route('reports.sales.index'),
  },
   {
    // id: 3,
    name: 'Sales Summary Report',
    route: '#',
    // route: route('reports.summary.index'),
  },
  {
    // id: 2,
    name: 'Services Report',
    route: '#',
    // route: route('reports.services.index'),
  },
    {
    // id: 3,
    name: 'Services Summary Report',
    route: '#',
    // route: route('reports.summary.index'),
  },
  {
    // id: 3,
    name: 'Summary Report',
    route: '#',
    // route: route('reports.summary.index'),
  },
  {
    // id: 3,
    name: 'Products Report',
    route: '#',
    // route: route('reports.summary.index'),
  },
  
];

// Compute selected branches (optional)
const selectedBranches = computed(() =>
  props.branches.filter((branch: any) => branch.isChecked)
);

// Handle Go Button Click (Navigate or Filter)
const goToReport = () => {
  // Example: navigate with selected branch IDs as query params
  const selectedIds = selectedBranches.value.map((branch: any) => branch.id);
  router.visit(route('reports.sales.index', { branches: selectedIds }));
};

</script>

<template>
  <Head :title="props.title" />
  
    <AppLayout :breadcrumbs="breadcrumbs" >
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="relative  flex-1">
                <AppNavigation />
            </div>
        </div>
    </AppLayout>
        <!-- <div class="flex h-full flex-col gap-4 rounded-xl p-4 overflow-x-auto"> -->
            <!-- <div class="grid gap-4 md:grid-cols-3"> -->
                
            <!-- Reports Dropdown -->
            <!-- <SelectDropdown :options="reports" label="Reports" /> -->

            <!-- <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select" />
                </SelectTrigger>
                <SelectContent position="popper">
                <SelectItem v-for="branch in branches" :value="branch.id">
                    {{ branch.name }}
                </SelectItem>
                </SelectContent>
            </Select>

            <Select>
                <SelectTrigger>
                    <SelectValue placeholder="Select" />
                </SelectTrigger>
                <SelectContent position="popper">
                <SelectItem v-for="branch in branches" :value="branch.id">
                    {{ branch.name }}
                </SelectItem>
                </SelectContent>
            </Select> -->

            <!-- Branch Filter Dropdown -->
            <!-- <SelectReports :items="branches" class="w-fit" /> -->

            <!-- Go Button -->
            <!-- <Button
            class="bg-blue-500 w-fit hover:bg-blue-800 cursor-pointer"
            @click="goToReport"
            >
            Go
            </Button> -->
            <!-- </div> -->

            <!-- Content Area -->
           <!-- <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            
            </div>  -->
        <!-- </div> -->
    <!-- </AppLayout> -->
</template>
