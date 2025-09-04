<script setup lang="ts">
import type { Table } from '@tanstack/vue-table'
import type { DermatologyDiagnosis, Patient } from '@/types';
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3';
import { HardDriveDownload, RefreshCcw } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import DataTableFacetedFilter from '@/components/reports/patients/Diagnosis/DataTableFacetedFilter.vue'

const page = usePage()

const dermatologyDiagnoses: Array<{ value: string; label: string }> = 
  ((page.props.dermatologyDiagnosis as DermatologyDiagnosis[]) ?? []).map(tag => ({
    value: tag.name.toLowerCase(),
    label: tag.name.toUpperCase(),
  }))

interface DataTableToolbarProps {
  table: Table<Patient>
}

const props = defineProps<DataTableToolbarProps>()

const isFiltered = computed(() => props.table.getState().columnFilters.length > 0)
</script>

<template>
<div class="flex items-center justify-between gap-5">
  <!-- 🔎 Left side: search + filters + total -->
  <div class="flex items-center gap-3">
    <!-- Search input -->
    <Input
      placeholder="Filter Patient..."
      :model-value="(table.getColumn('fullName')?.getFilterValue() as string) ?? ''"
      class="h-8 w-[150px] lg:w-[250px]"
      @input="table.getColumn('fullName')?.setFilterValue(($event.target as HTMLInputElement).value)"
    />

    <!-- Diagnosis filter -->
    <DataTableFacetedFilter
      v-if="table.getColumn('dermatologyDiagnosis')"
      :column="table.getColumn('dermatologyDiagnosis')"
      title="Diagnosis"
      :options="dermatologyDiagnoses"
    />

     <!-- Reset button -->
    <Button
      v-if="isFiltered"
      variant="outline"
      class="h-8 px-2 lg:px-3 flex justify-between items-center"
      @click="table.resetColumnFilters()"
    >
      
      <RefreshCcw class="text-green h-3 w-3" />
    </Button>
    <!-- Total -->
     <Button variant="outline" class="h-8 px-2 lg:px-3">
      <HardDriveDownload class="h-4 w-4" />
    </Button>
  </div>

  <!-- ⚡ Right side: actions -->
  <div class="flex items-center gap-2">
   <div class="rounded-md border bg-muted px-3 py-1 text-xs text-muted-foreground">
      Total: <span class="font-medium text-foreground">
        {{ table.getFilteredRowModel().rows.length }}
      </span>
    </div>

    <!-- Download button -->
   
  </div>
</div>

</template>
