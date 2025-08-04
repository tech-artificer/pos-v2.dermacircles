import { h } from 'vue'
import { ColumnDef } from '@tanstack/vue-table';
import { Patient } from '@/types'

// interface Patient {
//     patient_id: number
//     name: () => {
//         firstname: string,
//         lastname: string,
//         middlename: string
//     },

//     gender: string
//     address: string
//     contactNumber: string,
//     mdAssigned: number,
//     source: string,
//     civilStatus: string,
// }


export const getPatientReportColumns = (diagnosisTags: {tag_id: number, label: string}[]): ColumnDef<Patient>[] => [
   {
        accessorKey: 'fullName',  
        header: 'Patient',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.getValue('fullName') ?? '--')
        },          
    },
    // {
    //     accessorKey: 'address',  
    //     header: 'Address',
    //     cell: ({ row }) => {
    //         return h( 'div', { class: 'capitalize' }, row.original.address ?? '--')
    //     },          
    // },
    {
        accessorKey: '',  
        header: 'Tags',
        cell: ({ row }) => {
            const diagnosisList = row.original.diagnosis || [];

            // Collect matching tags from diagnosis entries
            const matchedTags = new Set<string>();
            // console.log('diagnosisTags', diagnosisTags);
            // console.log('diagnosisList', diagnosisList);
            diagnosisList.forEach((d: any) => {
                diagnosisTags.forEach((tag) => {
                    if (d.diagnosis?.toLowerCase().includes(tag.label.toLowerCase())) {
                        matchedTags.add(tag.label);
                    }
                });
            });

            // Turn matched tags into a display string
            const tagsText = Array.from(matchedTags).join(', ');

            // Trim if longer than 100 chars
            const trimmedTags = tagsText.length > 100 ? tagsText.slice(0, 100) + '...' : tagsText;

            return h('div', { class: 'capitalize' }, trimmedTags || '--');
        },          
    },
    {
        accessorKey: '',
        header: 'Diagnosis',
        cell: ({ row }) => {
            // TODO: Set number of characters to show
            const diagnosis = row.original.diagnosis || [];
            const diagnosisText = diagnosis.map(t => t.diagnosis).join(', ');
            const trimmedText = diagnosisText.length > 50 ? diagnosisText.slice(0, 50) + '...' : diagnosisText;
            return h( 'div', { class: 'capitalize' }, trimmedText || '--');
            // return h( 'div', { class: 'capitalize' },  row.original.diagnosis?.map(d => d.diagnosis).join(', ') || '--');
        },
    },
    {
        accessorKey: '',  
        header: 'Treatments',
        cell: ({ row }) => {
            // TODO: Set number of characters to show
            const treatments = row.original.treatments || [];
            const treatmentText = treatments.map(t => t.treatment).join(', ');
            const trimmedText = treatmentText.length > 50 ? treatmentText.slice(0, 50) + '...' : treatmentText;
            return h( 'div', { class: 'capitalize' }, trimmedText || '--');
            // return h( 'div', { class: 'capitalize' }, row.original.treatments?.map(t => t.treatment).join(', ') || '--')
        },          
    },
    {
        accessorKey: '',  
        header: 'MD',
        cell: ({ row }) => {
            return h( 'div', { class: 'capitalize' }, row.original.md?.name ?? '--')
            // const md = row.original.md ?? '';
            // return h( 'div', { class: 'capitalize' }, md?.name)
        },          
    },
]