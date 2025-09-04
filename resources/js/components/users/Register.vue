<script setup lang="ts">
import { Button } from "@/components/ui/button"
import { UserPlus } from 'lucide-vue-next';
import {
  Sheet,
  SheetContent,
  SheetDescription,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet"

import UserForm from '@/components/users/UserForm.vue';
</script>

<template>
  <Sheet key="register">
    <SheetTrigger as-child>
      <Button variant="outline" class="cursor-pointer">
        <UserPlus class="mr-2 h-4 w-4" /> New User
      </Button>
    </SheetTrigger>
    <SheetContent>
      <SheetHeader>
        <SheetTitle>New User</SheetTitle>
        <SheetDescription>
          Add a new user to the application. Please enter the name, email address, and select a role.
        </SheetDescription>
      </SheetHeader>
      <UserForm form-type="create" />
    </SheetContent>
  </Sheet>
</template>
