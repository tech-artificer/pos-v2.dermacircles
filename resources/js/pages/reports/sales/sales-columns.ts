import { h } from 'vue';
import { ColumnDef } from '@tanstack/vue-table';

export const getSalesColumns = (): ColumnDef<any>[] => [
    {
        accessorKey: '',
        header: 'Date',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.original.created_at.toLocaleDateString()),
    },
//     {
//         accessorKey: '',
//         header: 'Client',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, 'John Doe'),
//     }, 
//     {
//         accessorKey: '',
//         header: 'Particulars',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, 'Consultation'),
//     },
//     {
//         accessorKey: '',
//         header: 'Category',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, ''),
//     }, 
//     {
//         accessorKey: '',
//         header: 'Doctor',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, ''),
//     }, 
//     {
//         accessorKey: '',
//         header: 'Facialist',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, ''),
//     },
//     {
//         accessorKey: '',
//         header: 'Quantity',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, ''),
//     },
//     {
//         accessorKey: '',
//         header: 'Price/ Rate',
//         cell: ({ row }) => h('div', { class: 'capitalize' }, ''),
//     }, 
]