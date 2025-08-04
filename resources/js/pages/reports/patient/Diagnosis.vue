<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { getPatientReportColumns } from '@/pages/reports/patient/diagnosis-column'
import { onMounted, ref } from 'vue'
import DataTable from '@/pages/reports/patient/DataTable.vue'
import type { BreadcrumbItem } from '@/types';
import { Patient } from '@/types'
import { useForm , router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';

import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

const props = defineProps<{
  patients: Patient[],
  diagnosisTags: {tag_id: number, label: string}[],
  totalPatients: number,
  filters: {
    diagnosis: string | null;
  };
}>()

const columns = getPatientReportColumns(props.diagnosisTags);

const form = useForm({
  diagnosis: props.filters.diagnosis,
});

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Patients', href: '/reports/patients' },
  { title: 'Diagnosis', href: '/reports/patients/diagnosis' },
];

const goToPage = (url: string) => {

   form.get(url, { 
      preserveState: true,
      replace: true, // Replace history entry
    });
};

onMounted(() => {
  // console.log(props.filters);
  // console.log(form);
    // console.log(props.branches);
}) 

</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
      <pre>{{ form.diagnosis }}</pre>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg font-semibold">
        <!-- <div class="p-4 bg-gray-50 rounded-lg">
          Total Sales Amount (branch): 10.20
        </div> -->
        <div class="p-4 bg-gray-50 rounded-lg">
          Number of Patients: {{ totalPatients }}
        </div>
      </div>

       <div class="flex flex-row flex-wrap items-center gap-3 px-3 py-2">
        <div>
            <Select v-model="form.diagnosis">
              <SelectTrigger class="w-80">
                <SelectValue placeholder="Filter by Diagnosis" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Diagnosis</SelectLabel>
                  <SelectItem value="all" selected>
                    All
                  </SelectItem>
                  <SelectItem v-for="diagnosisTag in diagnosisTags" :key="diagnosisTag.tag_id" :value="diagnosisTag.label">
                    {{ diagnosisTag.label ? diagnosisTag.label.toLowerCase() : '--' }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
        </div>
         
        
       <div class="block">
          <Button class="mt-1 px-3 py-2 w-30 align-bottom bg-blue-500 hover:bg-blue-900 cursor-pointer rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            @click="goToPage(route('reports.patients.diagnosis', {diagnosis: form.diagnosis}))">
            <span class="text-sm">Filter</span>
          </Button>
        </div>
      </div>


      <div
        class="relative min-h-[100vh]">
        <DataTable :columns="columns" :rows="patients" />
      </div>
    </div>
  </AppLayout>
</template>