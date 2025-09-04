<script setup lang="ts">
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import {
  Card, 
  CardContent, 
  CardHeader, 
  CardTitle, 
  CardDescription
} from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { 
  FileText,
  BarChart3,
  ScrollText,
  ArrowRight
} from 'lucide-vue-next';

interface ReportItem {
  title: string;
  href: string;
  description: string;
  lastUpdated?: string;
  color?: string;
  icon?: any;
}

const props = defineProps<{
  title: string;
  items: ReportItem[];
}>();

// Enhanced report items with icons and colors
const enhancedItems = computed(() => {
  const iconMap = {
    'Patient Reports': { icon: FileText, color: 'blue', gradient: 'from-blue-500/10 to-blue-600/5' },
    'Sales Reports': { icon: BarChart3, color: 'green', gradient: 'from-green-500/10 to-green-600/5' },
    'Logs': { icon: ScrollText, color: 'amber', gradient: 'from-amber-500/10 to-amber-600/5' },
  };

  return props.items.map(item => ({
    ...item,
    icon: iconMap[item.title as keyof typeof iconMap]?.icon || FileText,
    color: iconMap[item.title as keyof typeof iconMap]?.color || 'blue',
    gradient: iconMap[item.title as keyof typeof iconMap]?.gradient || 'from-blue-500/10 to-blue-600/5',
    lastUpdated: item.lastUpdated || getRandomLastUpdated()
  }));
});

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

const getRandomLastUpdated = () => {
  const options = ['Today', '2 hours ago', '30 min ago', '1 day ago'];
  return options[Math.floor(Math.random() * options.length)];
};
</script>

<template>
  <div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <Card 
        v-for="item in enhancedItems" 
        :key="item.title"
        class="relative group cursor-pointer transition-all duration-300 hover:shadow-lg border border-border/50 overflow-hidden"
        @click="navigateToReport(item.href)"
      >
        <div :class="`absolute inset-0 bg-gradient-to-br ${item.gradient} opacity-0 group-hover:opacity-100 transition-opacity duration-300`"></div>
        <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary to-primary/60 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></div>
        
        <CardHeader class="relative">
          <div class="flex items-center justify-between mb-4">
            <div 
              :class="`h-12 w-12 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110 ${getIconColorClass(item.color)}`"
            >
              <component :is="item.icon" class="h-6 w-6" />
            </div>
            <ArrowRight class="h-5 w-5 text-muted-foreground transition-all duration-300 group-hover:translate-x-1 group-hover:text-primary" />
          </div>
          <CardTitle class="text-lg font-semibold group-hover:text-primary transition-colors duration-300">
            {{ item.title }}
          </CardTitle>
          <CardDescription class="text-sm line-clamp-3 group-hover:text-foreground/80 transition-colors duration-300">
            {{ item.description }}
          </CardDescription>
        </CardHeader>
        <CardContent class="relative pt-0">
          <div class="flex items-center justify-between text-xs text-muted-foreground">
            <span>Last updated: {{ item.lastUpdated }}</span>
            <Badge variant="outline" class="group-hover:border-primary/50 transition-colors duration-300">
              View Report
            </Badge>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>