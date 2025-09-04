<script setup lang="ts">
import {
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription
} from '@/components/ui/card';
import { router } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import { Badge } from '@/components/ui/badge';

defineProps<{
    reportItems: any
}>()

const navigateToReport = (href: string) => {
  router.visit(href);
};

const getIconColorClass = (color: string) => {
  const colorMap = {
    blue: 'text-blue-600 bg-blue-50 dark:bg-blue-950 dark:text-blue-400',
    green: 'text-green-600 bg-green-50 dark:bg-green-950 dark:text-green-400',
    amber: 'text-amber-600 bg-amber-50 dark:bg-amber-950 dark:text-amber-400',
  };
  return colorMap[color as keyof typeof colorMap] || colorMap.blue;
};

</script>

<template>
    <Card class="border-0 shadow-sm">
        <CardHeader class="border-b bg-gradient-to-r from-background to-muted/20">
          <CardTitle class="text-xl font-semibold">Available Reports</CardTitle>
          <CardDescription>
           List of available reports
          </CardDescription>
        </CardHeader>
        <CardContent class="p-6">
          <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <Card 
              v-for="report in reportItems" 
              :key="report.title"
              class="relative group cursor-pointer transition-all duration-300 hover:shadow-lg border border-border/50 overflow-hidden"
              @click="navigateToReport(report.href)"
            >
              <div :class="`absolute inset-0 bg-gradient-to-br ${report.gradient} opacity-0 group-hover:opacity-100 transition-opacity duration-300`"></div>
              <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary to-primary/60 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></div>
              
              <CardHeader class="relative">
                <div class="flex items-center justify-between mb-4">
                  <div 
                    :class="`h-12 w-12 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110 ${getIconColorClass(report.color)}`"
                  >
                    <component :is="report.icon" class="h-6 w-6" />
                  </div>
                  <ArrowRight class="h-5 w-5 text-muted-foreground transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary" />
                </div>
                <CardTitle class="text-lg font-semibold group-hover:text-primary transition-colors duration-300">
                  {{ report.title }}
                </CardTitle>
                <CardDescription class="text-sm line-clamp-2 group-hover:text-foreground/80 transition-colors duration-300">
                  {{ report.description }}
                </CardDescription>
              </CardHeader>
              <CardContent class="relative pt-0">
                <div class="flex items-center justify-between text-xs text-muted-foreground">
                  <span>Last updated: {{ report.lastUpdated }}</span>
                  <Badge variant="outline" class="group-hover:border-primary/50 transition-colors duration-300">
                    View Report
                  </Badge>
                </div>
              </CardContent>
            </Card>
          </div>
        </CardContent>
      </Card>
</template>