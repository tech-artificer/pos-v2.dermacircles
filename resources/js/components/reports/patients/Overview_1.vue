
<script setup lang="ts">
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { 
    type LucideIcon, 
    ChartSpline,
    Contact,
    ArrowUp10,
    ChartPie
} from 'lucide-vue-next';
interface DashCards {
  title?: string;
  value?: string | number;
  icon?: LucideIcon;
  helpText?: string;
}

const dashCards: DashCards[] = [
    {
        title: 'Total Patients',
        value: '1000',
        icon: ChartSpline,
        helpText: '50 Transactions',
    },
    {
        title: `Visits`,
        value: '2000',
        icon: ArrowUp10,
        helpText: 'Total Orders',
    },
    {
        title: `Items Purchased`,
        value: '1000',
        icon: Contact,
        helpText: 'Total Orders',
    },
    {
        title: `Monthly Sales`,
        value: '1000',
        icon: ChartPie,
        helpText: 'Sales for the month',
    },
];

</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- <Card v-for="dashCard in dashCards" :key="dashCard.title" class="border-0">
            <CardHeader class="flex flex-row items-center justify-between p-4 pb-2">
                <CardTitle class="text-sm font-medium">
                {{ dashCard.title }}
                </CardTitle>
                <component :is="dashCard.icon" class="text-woosoo-green " />   
            </CardHeader>
            <CardContent>
                <div class="text-2xl font-bold">
                {{ dashCard.value }}
                </div>
                <p class="text-xs text-muted-foreground">
                {{ dashCard.helpText }}
                </p>
            </CardContent>
        </Card> -->
    </div>
</template>