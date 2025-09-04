<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { toast } from 'vue-sonner'

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"

const form = useForm({
    name: '',
});

const submit = () => {
    form.post(route('roles.store'), {
        forceFormData: true,
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            toast('New Role:', {
                description: 'A new role has been created.',
                action: {
                    label: 'Ok',
                    variant: 'success',
                    onClick: () => console.log('Ok'),
                },
                duration: 5000,
                position: 'top-right',
            });
            form.reset();
        },
    });
};
</script>

<template>
    <div class="flex flex-col">
        <Card>
            <CardHeader>
                <CardTitle>Create a new role</CardTitle>
                <CardDescription>

                </CardDescription>
            </CardHeader>
            <CardContent class="space-y-2">
                <form @submit.prevent="submit" class="flex flex-col w-90 gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="email">Name</Label>
                            <Input id="email" type="email" required autofocus :tabindex="1" v-model="form.name"
                                class="border-blue-400" placeholder="Admin" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <!-- <Button @click="submit" type="submit" class="mt-4 w-full bg-blue hover:bg-blue-800"
                            :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Log in
                        </Button> -->
                    </div>

                </form>
            </CardContent>
            <CardFooter>
                <Button @click="submit" type="submit" class="mt-4  bg-blue hover:bg-blue-800" :tabindex="4"
                    :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Save
                </Button>
            </CardFooter>
        </Card>

    </div>
</template>
