import { h } from 'vue'
import { ColumnDef } from '@tanstack/vue-table';
import { Patient } from '@/types'
import { ArrowUpDown, ChevronDown, Divide } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'

export const getPatientReportColumns = (): ColumnDef<Patient>[] => [
   {
        accessorKey: 'fullName',  
        header: 'NAME',
          
        
        // header: ({ column }) => {
        //     return h(Button, {
        //         variant: 'ghost',
        //         onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
        //     }, () => ['Name', h(ArrowUpDown, { class: '' })])
        // },
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('fullName') ?? '--')
        },          
    },
    {
        accessorKey: 'civil_status',  
        header: 'CIVIL STATUS',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('civil_status') ?? '--')
        },          
    },
    // {
    //     accessorKey: 'gender',  
    //     header: 'Gender',
    //     cell: ({ row }) => {
    //         return h( 'div', { class: 'capitalize' }, row.getValue('gender') ?? '--')
    //     },          
    // },
    {
        accessorKey: 'gender',  
        header: 'Gender',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('gender') ?? '--')
        },          
    },
    {
        accessorKey: 'birthdate',  
        header: 'BIRTHDATE',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('birthdate') ?? '--')
        },          
    },
    {
        accessorKey: '',  
        header: 'Age',
        cell: ({ row }) => {
            const birthdate = row.getValue('birthdate');

            if (!birthdate) {
                return h( 'div', { class: 'capitalize' }, '--');
            }

            const age = new Date().getFullYear() - new Date(birthdate.toString()).getFullYear();
            return h( 'div', { class: 'capitalize' }, age ?? '--')
        },          
    },
    {
        accessorKey: 'contact_number',  
        header: 'Contact #',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('contact_number') ?? '--')
        },          
    },
    {
        accessorKey: 'email_address',  
        header: 'Email',
        cell: ({ row }) => {
            return h( 'div', { class: '' }, row.getValue('email_address') ?? '--')
        },          
    },
    {
        accessorKey: 'address',  
        header: 'Address',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.original.address ?? '--')
        },          
    },
    {
        accessorKey: 'source',  
        header: 'Source',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('source') ?? '--')
        },          
    }
]