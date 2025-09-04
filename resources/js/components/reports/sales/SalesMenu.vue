<script setup lang="ts">
import {
  ChevronRight,
  ChevronDown
} from "lucide-vue-next"

import { Button } from "@/components/ui/button"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuPortal,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuSub,
  DropdownMenuSubContent,
  DropdownMenuSubTrigger,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import { Link } from '@inertiajs/vue3';

defineProps<{
  title: string,
  items: any,  
}>()

</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="outline">
        {{ title }} <ChevronDown />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="w-56">
      <DropdownMenuLabel>Reports</DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuGroup>
        <DropdownMenuItem v-for="item in items" @click="route(item.href)">
          <ChevronRight class="mr-2 h-4 w-4" />
          <Link :href="item.href" as="button" class="cursor-pointer">{{ item.title }} </Link>
          <DropdownMenuShortcut></DropdownMenuShortcut> 
        </DropdownMenuItem>
        </DropdownMenuGroup>
    </DropdownMenuContent>
  </DropdownMenu>
</template>