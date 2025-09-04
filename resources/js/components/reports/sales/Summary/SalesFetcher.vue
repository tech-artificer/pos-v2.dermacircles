<!-- SalesReportFetcher.vue -->

<script setup lang="ts">
import { computed, reactive } from 'vue'
import {
  Calendar as CalendarIcon,
  CalendarDays as CalendarDaysIcon,
  Download as DownloadIcon,
  Loader2 as LoaderIcon,
  TrendingUp as TrendingUpIcon,
  AlertCircle as AlertCircleIcon
} from 'lucide-vue-next'
import { ToggleGroup, ToggleGroupItem } from "@/components/ui/toggle-group"
import { label } from '@unovis/ts/components/axis/style'

const props = reactive({
  startDate: '',
  endDate: ''
})

// const isLoading = ref(false)
// const reportData = ref<SalesReportData | null>(null)
// const errors = reactive({
// //   startDate: '',
// //   endDate: ''
// })
// const generalError = ref('')

// Computed properties
const today = computed(() => new Date().toISOString().split('T')[0])

// const canGenerate = computed(() => {
//       form.startDate && form.endDate && !Object.values(errors).some(Boolean)
// })

// Methods
const validateForm = (): boolean => {
  // Reset errors
  // errors.startDate = ''
  // errors.endDate = ''
  // generalError.value = ''

  if (!props.startDate) {
    // errors.startDate = 'Start date is required'
    return false
  }

  if (!props.endDate) {
    // errors.endDate = 'End date is required'
    return false
  }

  if (new Date(props.startDate) > new Date(props.endDate)) {
    // errors.endDate = 'End date must be after start date'
    return false
  }

  if (new Date(props.endDate) > new Date()) {
    // errors.endDate = 'End date cannot be in the future'
    return false
  }

  //   // Check if date range is too large (optional business rule)
  const daysDifference = Math.ceil(
    (new Date(props.endDate).getTime() - new Date(props.startDate).getTime()) / (1000 * 3600 * 24)
  )

  if (daysDifference > 365) {
    // generalError.value = 'Date range cannot exceed 365 days'
    return false
  }

  return true
}

const setQuickRange = (days: number) => {

  const end = new Date()
  const start = new Date(Date.now() - days * 24 * 60 * 60 * 1000)

  props.endDate = end.toISOString().split('T')[0]
  props.startDate = start.toISOString().split('T')[0]
}

// Utility functions
// const formatCurrency = (amount: number): string => {
//   return new Intl.NumberFormat('en-US', {
//     style: 'currency',
//     currency: 'USD'
//   }).format(amount)
// }

const formatDateRange = (start: string, end: string): string => {
  const startDate = new Date(start).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })

  const endDate = new Date(end).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })

  return `${startDate} - ${endDate}`
}

// Initialize with default range (last 30 days)
setQuickRange(0)
</script>
<template>

  <div class="flex flex-col">
    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2 mb-4">
      <CalendarIcon class="w-5 h-5" />
      Select Date Range
    </h2>
    <div class="flex flex-row flex-wrap justify-start items-center gap-6 p-4 border rounded-lg shadow-sm bg-gray-5">

      <!-- Quick Range Buttons -->
      <div class="">
        <label class="font-medium text-gray-700">Quick Ranges</label>
        <ToggleGroup default-value="today" type="single" class="flex mt-2">
          <ToggleGroupItem value="today" variant="outline" aria-label="Toggle Seven Days" @click="setQuickRange(0)"
            class="px-6">
            Today
          </ToggleGroupItem>
          <ToggleGroupItem value="seven" variant="outline" aria-label="Toggle Seven Days" @click="setQuickRange(7)"
            class="px-6">
            Last 7 days
          </ToggleGroupItem>
          <ToggleGroupItem value="thirty" variant="outline" aria-label="Toggle Thirty Days" @click="setQuickRange(30)"
            class="px-6">
            Last 30 days
          </ToggleGroupItem>
          <ToggleGroupItem value="ninety" variant="outline" aria-label="Toggle Ninety Days" @click="setQuickRange(90)"
            class="px-6">
            Last 90 days
          </ToggleGroupItem>
        </ToggleGroup>

      </div>
      <!-- Date Inputs -->
      <div class="grid md:grid-cols-2 gap-4">
        <div class="flex justify-start flex-col">
          <label class="font-medium text-gray-700">Start Date</label>
          <div class="relative">
            <input id="startDate" v-model="props.startDate" type="date" :max="today"
              @change="() => { if (props.endDate && props.startDate > props.endDate) props.endDate = props.startDate }"
              class="mt-2 w-full pl-10 pr-3 py-1.5 border border-gray-300 text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            <CalendarDaysIcon class="absolute left-3 top-1/2 transform -translate-y-1/3 w-4 h-4 text-gray-400" />
          </div>
        </div>

        <div class="flex justify-start flex-col">
          <label class="font-medium text-gray-700">End Date</label>
          <div class="relative">
            <input id="endDate" v-model="props.endDate" type="date" :max="today" :min="props.startDate"
              @change="() => { if (props.startDate && props.endDate < props.startDate) props.startDate = props.endDate }"
              class="mt-2 w-full pl-10 pr-3 py-1.5 border border-gray-300 text-sm  rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />

            <CalendarDaysIcon class="absolute left-3 top-1/2 transform -translate-y-1/3 w-4 h-4 text-gray-400" />
          </div>

        </div>
      </div>
    </div>
  </div>

</template>


<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-out;
}

.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}
</style>