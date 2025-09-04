<script setup lang="ts">
import {
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription
} from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';



defineProps<{
  statistics: any
}>()

</script>

<template>
   <Card 
          v-for="stat in statistics" 
          :key="stat.title"
          class="relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-0 bg-gradient-to-br from-background to-muted/20"
        >
          <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-primary/60"></div>
          <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-sm font-medium text-muted-foreground">
              {{ stat.title }}
            </CardTitle>
            <div class="h-10 w-10 rounded-lg flex items-center justify-center bg-blue-100">
              <component :is="stat.icon" class="h-5 w-5 text-blue-600" />
            </div>
          </CardHeader>
          <CardContent>
            <div class="text-2xl font-bold text-foreground mb-1">{{ stat.value }}</div>
            <div class="flex items-center justify-between">
              <p class="text-xs text-muted-foreground">{{ stat.subtitle }}</p>
              <Badge 
                :variant="stat.trendUp ? 'accent' : 'secondary'" 
                class="text-xs"
                :class="stat.trendUp ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'"
              >
                {{ stat.trend }}
              </Badge>
            </div>
          </CardContent>
        </Card>
</template>
