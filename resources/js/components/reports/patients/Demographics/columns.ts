import type { ColumnDef } from '@tanstack/vue-table'
import type { Patient } from '@/types';
import { h } from 'vue'
import DataTableColumnHeader from '@/components/reports/patients/Demographics/DataTableColumnHeader.vue'

export const columns: ColumnDef<Patient, any>[] = [
     {
        accessorKey: 'fullName',
        header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Name', class: 'w-[150px]' }),
        
        cell: ({ row }) => {
          return h('div', { class: 'flex space-x-2' }, [
            h('span', { class: 'capitalize' }, row.getValue('fullName'))
          ])
        },
      },

    {
        accessorKey: 'civil_status',
        header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Status' }),
        enableColumnFilter: false,
        enableSorting: false,
        cell: ({ row }) => {

            return h('div', { class: 'flex space-x-2' }, [
                h('span', { class: 'max-w-[500px] capitalize' }, row.getValue('civil_status'))
            ])
        },
    },
    {
        accessorKey: 'gender',
        header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Gender' }),
        enableColumnFilter: false,
        enableSorting: false,
        cell: ({ row }) => {

            return h('div', { class: 'flex space-x-2' }, [
                h('span', { class: 'max-w-[500px] capitalize' }, row.getValue('gender'))
            ])
        },
    },
    {
        accessorKey: 'birthdate',
        header: ({ column }) => h(DataTableColumnHeader, { column, title: 'Age' }),
        cell: ({ row }) => {

            const birthdate = row.getValue('birthdate');

            if (!birthdate) {
                return h('div', { class: 'capitalize' });
            }

            const age = new Date().getFullYear() - new Date(birthdate.toString()).getFullYear();
            return h('div', { class: 'capitalize' }, age);
        },
    },
    {
        accessorKey: 'contact_number',
        header: 'Contact #',
        cell: ({ row }) => {
            return h('div', { class: 'capitalize' }, row.getValue('contact_number'))
        },
    },
    {
        accessorKey: 'email_address',
        header: 'Email',
        cell: ({ row }) => {
            return h('div', { class: '' }, row.getValue('email_address'))
        },
    },
    {
        accessorKey: 'address',
        header: 'Address',
        cell: ({ row }) => {
            return h('div', { class: 'capitalize' }, row.original.address)
        },
    },
    {
        accessorKey: 'source',
        header: 'Source',
        cell: ({ row }) => {
            return h('div', { class: 'capitalize' }, row.getValue('source'))
        },
    },
]
