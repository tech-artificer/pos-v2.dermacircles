<script setup lang="ts" generic="TData, TValue">
import { ref, defineProps } from 'vue'
import { ColumnDef, ColumnFiltersState,
  ExpandedState,
  SortingState,
  VisibilityState, } from '@tanstack/vue-table'
import TablePagination from '@/pages/reports/patient/DataTablePagination.vue'

import {
  FlexRender,
  getCoreRowModel,
  useVueTable,
  getPaginationRowModel,
  getFilteredRowModel,
  getSortedRowModel
} from '@tanstack/vue-table'

import { Search } from 'lucide-vue-next'
import { Input } from '@/components/ui/input'

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

import DebouncedInput from '@/components/datatable/DebouncedInput.vue'
import Filter from '@/components/datatable//Filter.vue'

import { valueUpdater } from '@/lib/utils'

const props = defineProps<{
  columns: ColumnDef<Object | any>[]
  rows: Object[];
}>()

// interface ColumnFilter {
//   fullName?: string;
//   mdAssigned?: string;
//   source?: string;
//   civilStatus?: string;
//   gender?: string;
// }
// type ColumnFiltersState = ColumnFilter[];

const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const globalFilter = ref('')
const columnVisibility = ref<VisibilityState>({})
const rowSelection = ref({})
const expanded = ref<ExpandedState>({})

const table = useVueTable({
  get data() { return props.rows },
  get columns() { return props.columns },
  onColumnFiltersChange: updaterOrValue => {
    columnFilters.value =
      typeof updaterOrValue === 'function'
        ? updaterOrValue(columnFilters.value)
        : updaterOrValue
  },
  onGlobalFilterChange: updaterOrValue => {
    globalFilter.value =
      typeof updaterOrValue === 'function'
        ? updaterOrValue(globalFilter.value)
        : updaterOrValue
  },
  onSortingChange: updaterOrValue => {
    sorting.value =
      typeof updaterOrValue === 'function'
        ? updaterOrValue(sorting.value)
        : updaterOrValue
  },
  state: {
      get columnFilters() { return columnFilters.value },
      get globalFilter() { return globalFilter.value },
      get sorting() { return sorting.value },
  },
  initialState: {
    pagination: {
      pageSize: 50,
    }
  },
  getFilteredRowModel: getFilteredRowModel(),
  getSortedRowModel: getSortedRowModel(),
  getCoreRowModel: getCoreRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
})
</script>

<template>

  <div class="flex flex-col gap-4 px-3">

    <div class="relative w-full max-w-sm items-center">
       <DebouncedInput
        :modelValue="globalFilter ?? ''"
        @update:modelValue="value => (globalFilter = String(value))"
        className="px-2 py-2 font-lg shadow border border-block w-100 rounded border-blue-500 focus:border-blue-500 focus:ring-blue-500 focus:ring-1 focus:outline-none"
        placeholder="Search Patient..."
      />
    </div>

    <div class="rounded-md">
      <Table>
        <TableHeader>
          <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
            <TableHead v-for="header in headerGroup.headers" :key="header.id">
              <FlexRender
                v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                :props="header.getContext()"
              />
            </TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          <template v-if="table.getRowModel().rows?.length">
            <TableRow
              v-for="row in table.getRowModel().rows" :key="row.id"
              :data-state="row.getIsSelected() ? 'selected' : undefined"
            >
              <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
              </TableCell>
            </TableRow>
          </template>
          <template v-else>
            <TableRow>
              <TableCell :colspan="columns.length" class="h-24 text-center">
                No results.
              </TableCell>
            </TableRow>
          </template>
        </TableBody>
      </Table>
    </div>

    <div>
    <div class="flex items-center justify-end py-4 space-x-2">
      <TablePagination :table="table" />
    </div>
  </div>
  </div>
</template>