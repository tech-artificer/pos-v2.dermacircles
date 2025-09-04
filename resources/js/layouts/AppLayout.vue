<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType } from '@/types';
import { Toaster } from '@/components/ui/sonner'
import 'vue-sonner/style.css' 

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col bg-white gap-4 rounded p-6">
            <slot />
        </div>
        <Toaster />
    </AppLayout>
</template>
