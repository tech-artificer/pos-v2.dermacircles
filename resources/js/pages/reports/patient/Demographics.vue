<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { getPatientReportColumns } from '@/pages/reports/patient/demographics-column'
import DataTable from '@/pages/reports/patient/DataTable.vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import { Patient } from '@/types'
import { ref, watch, computed, onMounted } from 'vue';
// import { debounce } from 'lodash';
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

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Reports', href: '/reports' },
  { title: 'Patients', href: '/reports/patients' },
  { title: 'Demographics', href: '/reports/patients/demographics' },
];

const props = defineProps<{
  patients: Patient[],
  genderTags: string[],
  civilStatusTags: string[],
  sourceTags: string[],
  totalPatients: number ,
  filters: {
    civil_status: string | null;
    gender: string | null;
    source: string | null;
  };
}>()

const columns = getPatientReportColumns();

const form = useForm({
    civil_status: props.filters.civil_status,
    source: props.filters.source,
    gender: props.filters.gender,
});

// watch(form, debounce(() => {
//     router.get(route('reports.patients.demographics'), form.value, {
//         preserveState: true,
//         replace: true, // Replace history entry
//     });
// }, 300)); // 300ms debounce

const goToPage = (url: string) => {

   form.get(url, { 
      preserveState: true,
      replace: true, // Replace history entry
      onFinish: () => form.reset('civil_status', 'source', 'gender'),
    });
};

onMounted(() => {
  console.log(props.filters);
  console.log(form);
    // console.log(props.branches);
}) 
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">

    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg font-semibold">
        <div class="p-4 bg-gray-50 rounded-lg">
          <small>Total number of patients:</small> {{ totalPatients }}
        </div>
      </div>
      
      <div class="flex flex-row flex-wrap items-center gap-3 px-3 py-2">
        <div>
            <Select v-model="form.civil_status">
              <SelectTrigger class="w-80">
                <SelectValue placeholder="Select Civil Status" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Civil Status</SelectLabel>
                  <SelectItem value="all" selected>
                    All
                  </SelectItem>
                  <SelectItem v-for="civilStatus in civilStatusTags" :key="civilStatus" :value="civilStatus">
                    {{ civilStatus }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
        </div>
        
        <div>
            <Select v-model="form.source">
              <SelectTrigger class="w-80">
                <SelectValue placeholder="Select Source" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Source</SelectLabel>
                  <SelectItem value="all">
                    All
                  </SelectItem>
                  <SelectItem v-for="sourceTag in sourceTags" :value="sourceTag">
                    {{ sourceTag }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
        </div>

         
        <div>
            <Select v-model="form.gender" >
              <SelectTrigger class="w-80">
                <SelectValue placeholder="Select Gender" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup>
                  <SelectLabel>Gender</SelectLabel>
                  <SelectItem value="all">
                    All
                  </SelectItem>
                  <SelectItem v-for="genderTag in genderTags" :value="genderTag">
                    {{ genderTag }}
                  </SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
        </div>

         <div class="block">
          <Button class="mt-1 px-3 py-2 w-30 align-bottom bg-blue-500 hover:bg-blue-900 cursor-pointer rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            @click="goToPage(route('reports.patients.demographics'))">
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