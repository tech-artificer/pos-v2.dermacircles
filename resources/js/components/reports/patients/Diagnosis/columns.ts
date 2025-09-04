import type { ColumnDef } from '@tanstack/vue-table'
import type { Patient, Diagnosis, Treatment, Employee } from '@/types';
import { h } from 'vue'
import { Badge } from '@/components/ui/badge'
import DataTableColumnHeader from '@/components/reports/patients/Diagnosis/DataTableColumnHeader.vue'

export const columns: ColumnDef<Patient, any>[] = [
  {
    accessorKey: 'fullName',
    header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Name', class: 'w-[150px]' }),

    cell: ({ row }) => {
      return h('div', { class: 'flex' }, [
        h('span', { class: 'capitalize' }, row.getValue('fullName'))
      ])
    },
  },
  {
    accessorKey: 'diagnosis',
    enableColumnFilter: false,
    enableSorting: false,
    header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Findings' }),
    cell: ({ row }) => {
      const diagnosis = row.getValue('diagnosis') as Diagnosis[];

      return h('div', { class: 'flex' }, [
        h('ol', { class: 'max-w-[500px] list-decimal pl-6' }, diagnosis?.map((diagnosis, index) => [
          h('li', { class: 'text-wrap' }, [
            // treatment name
            h('span', `(${diagnosis.transaction_date}) - ${diagnosis.diagnosis}`),

            // therapist
            diagnosis.user?.therapist?.name
              ? h('span', { class: 'px-2 py-0.5 text-xs text-blue-500 rounded-full' }, diagnosis.user.therapist.name)
              : ''
         ])
        ]))
      ])
    },
  },
  {
    accessorKey: 'dermatologyDiagnosis',
    enableSorting: false,
    enableColumnFilter: true,

    // Works with: string search OR string[] multi-select
    filterFn: (row, columnId, filterValue) => {
      const tags = row.getValue(columnId) as string[] | undefined
      if (!tags?.length) return false

      // text search
      if (typeof filterValue === 'string') {
        const q = filterValue.trim().toLowerCase()
        if (!q) return true // empty query = no filtering
        return tags.some(t => t?.toLowerCase().includes(q))
      }

      // multi-select (match ANY selected)
      if (Array.isArray(filterValue)) {
        if (filterValue.length === 0) return true
        const sel = new Set(filterValue.map(v => String(v).toLowerCase()))
        return tags.some(t => sel.has(String(t).toLowerCase()))
      }

      return false
    },

    header: ({ column }) =>
      h(DataTableColumnHeader, { column, title: 'Tags' }),

    cell: ({ row }) => {
      const tags = row.getValue('dermatologyDiagnosis') as string[] | undefined
      if (!tags?.length) return h('div', { class: 'flex' }, [])
      return h(
        'div',
        { class: 'flex flex-wrap gap-1' },
        tags.map(tag =>
          h(Badge, { variant: 'destructive', class: 'capitalize' }, () => tag)
        )
      )
    },
  },

  {
    accessorKey: 'treatments',
    enableColumnFilter: false,
    enableSorting: false,
    header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Treatments' }),
    cell: ({ row }) => {
      const treatments = row.getValue('treatments') as Treatment[];

      return h('div', { class: 'flex' }, [
        h('ol', { class: 'max-w-[500px] list-decimal pl-6' }, treatments?.map((treatment, index) => [
          h('li', { class: 'text-wrap' }, [
            // treatment name
            h('span', `(${treatment.transaction_date}) - ${treatment.treatment}`),
            // therapist
            treatment.user?.therapist?.name
              ? h('span', { class: 'px-2 py-0.5 text-xs text-blue-500 rounded-full' }, treatment.user.therapist.name)
              : ''
          ])
        ]))
      ])

    }
  },

  {
    accessorKey: 'md',
    enableColumnFilter: false,
    enableSorting: false,
    header: ({ column }) => h(DataTableColumnHeader, { column, title: 'MD' }),
    cell: ({ row }) => {

      console.log(row.getValue('md'));
      const md = row.getValue('md') as Employee;
      return h('div', { class: 'flex' }, [
        h('span', { class: 'max-w-[500px] text-blue-500 text-wrap' }, md?.name)
      ])

    }

  },
]
