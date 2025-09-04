<script setup lang="ts">
import type { Table } from '@tanstack/vue-table'
import type { Patient } from '@/types';
import { computed } from 'vue'

import { Plus, HardDriveDownload } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'

import { civil_status, referrals } from '@/composables/useData'
import DataTableFacetedFilter from '@/components/reports/patients/Demographics/DataTableFacetedFilter.vue'

interface DataTableToolbarProps {
  table: Table<Patient>
}

const props = defineProps<DataTableToolbarProps>()

const isFiltered = computed(() => props.table.getState().columnFilters.length > 0)
</script>

<template>
  <div class="flex items-center justify-between">
    <div class="flex flex-1 items-center space-x-2">
      <Input
        placeholder="Filter Patient..."
        :model-value="(table.getColumn('fullName')?.getFilterValue() as string) ?? ''"
        class="h-8 w-[150px] lg:w-[250px]"
        @input="table.getColumn('fullName')?.setFilterValue($event.target.value)"
      /> 
     <DataTableFacetedFilter
        v-if="table.getColumn('civil_status')"
        :column="table.getColumn('civil_status')"
        title="Civil Status"
        :options="civil_status"
      /> 
       <DataTableFacetedFilter
        v-if="table.getColumn('source')"
        :column="table.getColumn('source')"
        title="Referrals"
        :options="referrals"
      /> 

       <Button variant="outline" class="h-8 px-2 lg:px-3">
          <HardDriveDownload class="h-4 w-4" />
        </Button>
    
      <Button
        v-if="isFiltered"
        variant="default"
        class="h-8 px-2 lg:px-3"
        @click="table.resetColumnFilters()"
      >
        Reset
        <Plus class="ml-2 h-4 w-4" />
      </Button> 
    </div>

      <div class="flex items-center gap-2">
   <div class="rounded-md border bg-muted px-3 py-1 text-xs text-muted-foreground">
      Filtered: <span class="font-medium text-foreground">
       {{ table.getFilteredRowModel().rows.length }}
      </span>
    </div>

    <!-- Download button -->
   
  </div>
  
  </div>
</template>
