<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from "@/components/ui/tabs"


import RolePermission from '@/components/accessibility/Index.vue'
import RoleIndex from '@/components/roles/Index.vue'
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Access Control',
        href: route('accessibility.index'),
    },
];

defineProps<{
    title: string;
    description: string;
}>()

</script>

<template>

    <Head :title="title" :description="description" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Tabs default-value="accessibility" class="w-full">
            <TabsList class="grid w-full grid-cols-2">
                <TabsTrigger value="accessibility">
                    User accessibility
                </TabsTrigger>
                <TabsTrigger value="roles">
                    Manage Roles
                </TabsTrigger>
            </TabsList>
            <TabsContent value="accessibility">
                <RolePermission />
            </TabsContent>
            <TabsContent value="roles">
                <div class="flex flex-col flex-wrap justify-between gap-4">
                    <RoleIndex />
                </div>
               
            </TabsContent>
        </Tabs>
    </AppLayout>
</template>