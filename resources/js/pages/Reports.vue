<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import AppNavigation from '@/components/AppNavigation.vue';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
];

const props = defineProps<{
  title: string;
  description: string;
  branches: Object[];
}>();

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
</template>
