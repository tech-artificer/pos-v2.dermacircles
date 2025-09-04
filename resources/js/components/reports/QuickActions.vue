<script setup lang="ts">
import {
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription
} from '@/components/ui/card';
import { Button } from '@/components/ui/button';

defineProps<{
    quickActions: any
}>();
</script>


<template>
    <Card class="border-0 shadow-sm">
        <CardHeader>
          <CardTitle class="text-lg font-semibold">Quick Actions</CardTitle>
          <CardDescription>
            Frequently used report functions and utilities
          </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <Button
              v-for="action in quickActions"
              :key="action.title"
              variant="outline"
              class="h-auto p-4 justify-start gap-3 hover:bg-primary/5 hover:border-primary/50 transition-all duration-300 hover:-translate-y-1"
              @click="action.action"
            >
              <div class="h-8 w-8 rounded-md bg-primary/10 flex items-center justify-center flex-shrink-0">
                <component :is="action.icon" class="h-4 w-4 text-primary" />
              </div>
              <span class="text-sm font-medium">{{ action.title }}</span>
            </Button>
          </div>
        </CardContent>
      </Card>
</template>
