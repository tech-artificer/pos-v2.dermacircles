<script lang="ts" setup>
import { Ref, ref, toRefs, watch } from 'vue'
import type { DropdownMenuCheckboxItemProps } from 'reka-ui'
import { Button } from '@/components/ui/button'
import {
  DropdownMenu,
  DropdownMenuCheckboxItem,
  DropdownMenuContent,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

interface Branch {
    name: string;
    id: number;
    isChecked: Ref<boolean>;
}

const props = defineProps<{
    items: Branch[];
}>()

// Optional: Create a local reactive copy if you plan to mutate them
const branches = ref<Branch[]>(props.items)

// Optional Watcher to sync back to parent if needed
// watch(branches, (newVal) => {
//   emit('update:items', newVal)
// }, { deep: true })
</script>

<template>
  <DropdownMenu class="w-fit">
    <DropdownMenuTrigger as-child>
      <Button variant="outline">
        Filter: Branch
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-56">
      <DropdownMenuLabel>Filter By Branch</DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuCheckboxItem 
        v-for="branch in branches"
        :key="branch.id"
        v-model:model-value="branch.isChecked"
      >
        {{ branch.name }}
      </DropdownMenuCheckboxItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
