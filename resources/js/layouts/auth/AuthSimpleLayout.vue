<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <!-- <div class="flex min-h-svh flex-col items-center">
        <div class="w-full">
            <div class="flex flex-col gap-8"> -->
                <!-- <div class="flex flex-col items-center gap-4"> -->
                    <!-- <Link :href="route('home')" class="flex flex-col items-center gap-2 font-medium">
                        <div class="mb-1 flex items-center justify-center rounded-md">
                            <AppLogoIcon class="fill-current text-[var(--foreground)] dark:text-white" />
                        </div>
                        <span class="sr-only">{{ title }}</span>
                    </Link> -->
                    <!-- <div class="space-y-2 text-center">
                        <h1 class="text-xl text-blue-900 font-medium">{{ title }}</h1>
                        <p class="text-center text-sm text-blue-800">{{ description }}</p>
                    </div> -->
                <!-- </div> -->
                 
                <slot />
            <!-- </div>
        </div>
    </div> -->
</template>
