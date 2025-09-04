<script setup lang="ts">
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { usePage, useForm } from '@inertiajs/vue3';
import { Role } from "@/types"
import { onMounted } from 'vue';
import AddRole from '@/components/roles/AddRole.vue';

const page = usePage();
const roles = computed(() => page.props.roles as Role[])


// onMounted(() => {
//     console.log(fetchRoles());
// })
</script>

<template>
    <div>
        <AddRole />
    </div>
 <div>
    <div class="flex flex-col">
        <Card>
            <CardHeader>
                <CardTitle>User Roles</CardTitle>               
                <CardDescription>
                    A list of existing roles and the number of users assigned to them
                </CardDescription>
            </CardHeader>
            <CardContent class="space-y-2">
            <Table>
        <TableCaption></TableCaption>
        <TableHeader>
        <TableRow>
            <TableHead>
            Name
            </TableHead>
            <TableHead>Users</TableHead>
        </TableRow>
        </TableHeader>
        <TableBody>
        <TableRow v-for="role in roles" :key="role.id">
            <TableCell class="font-medium">
            {{ role.name }}
            </TableCell>
            <TableCell>
            {{ role.users_count }}
            </TableCell>
        </TableRow> 
        </TableBody>
    </Table>
            </CardContent>
            <CardFooter>
              
            </CardFooter>
        </Card>

    </div>
   
  </div>
</template>