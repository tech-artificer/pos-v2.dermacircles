<script setup lang="ts">
import { saveAs } from 'file-saver';
import Papa from 'papaparse';
import { Button } from '@/components/ui/button';

const props = defineProps<{
    table: any;
    type: 'csv' | 'excel' | 'print';
}>();

const exportTable = () => {
    const rows = props.table.getRowModel().rows;
    const data = rows.map((row: any) =>
        row.getVisibleCells().reduce((acc: any, cell: any) => {
            acc[cell.column.id] = cell.getValue();
            return acc;
        }, {})
    );

    if (props.type === 'csv') {
        const csv = Papa.unparse(data);
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        saveAs(blob, 'table-export.csv');
    }

    if (props.type === 'print') {
        const printWindow = window.open('', '', 'width=900,height=650');
        printWindow!.document.write('<html><head><title>Print Table</title></head><body>');
        printWindow!.document.write('<table border="1"><thead><tr>');
        props.table.getAllLeafColumns().forEach((col: any) => {
            printWindow!.document.write(`<th>${col.columnDef.header}</th>`);
        });
        printWindow!.document.write('</tr></thead><tbody>');
        data.forEach((row: any) => {
            printWindow!.document.write('<tr>');
            Object.values(row).forEach((cell: any) => {
                printWindow!.document.write(`<td>${cell}</td>`);
            });
            printWindow!.document.write('</tr>');
        });
        printWindow!.document.write('</tbody></table></body></html>');
        printWindow!.document.close();
        printWindow!.print();
    }
};
</script>

<template>
  <Button @click="exportTable">
    Export {{ type.toUpperCase() }}
  </Button>
</template>
