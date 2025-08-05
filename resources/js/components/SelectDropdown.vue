<script setup lang="ts">
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'

// 
// interface Option {
//     id?: number;
//     name?: string;
//     route?: string;
// }

defineProps<{
    label: string;
    options: any[];
}>()

</script>

<template>
  <Select>
    <SelectTrigger class="border-1 border-blue-400">
      <SelectValue placeholder="Select"  />
    </SelectTrigger>
    <SelectContent>
      <SelectGroup>
        <SelectLabel>{{ label }}</SelectLabel>
        <SelectItem v-for="option in options" :value="option.id">
          {{ option.name }}
        </SelectItem>
      </SelectGroup>
    </SelectContent>
  </Select>
</template>
