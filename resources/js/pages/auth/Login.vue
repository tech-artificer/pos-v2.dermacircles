<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import SelectDropdown from '@/components/SelectDropdown.vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';


interface Branch {
    id: number;
    name: string;
}

defineProps<{
    status?: string;
    canResetPassword: boolean;
    branches: Branch[];
}>();

const form = useForm({
    email: '',
    password: '',
    branch: '',
    remember: false,
});

const submit = () => {
    // console.log(form);
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <AuthBase title="Reports">
        <div class="custom-shape-divider-top-1756522548">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="shape-fill"></path>
            </svg>
        </div>
        <div class="grid h-100 min-h-svh lg:grid-cols-2 overflow-hidden">

            <div class="flex flex-row items-center justify-center">

                <div class="bg-white z-1 shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] p-8 flex flex-col gap-6 justify-center items-center">
                    <Link :href="route('dashboard')" class="flex flex-col justify-center items-center gap-2 size-40 ">
                    
                        <div class="mb-1 rounded-md">
                            <AppLogoIcon class="fill-current text-[var(--foreground)] dark:text-white" />
                        </div>
                        <span class="sr-only"></span>
                    </Link>
                    <!-- <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                        {{ status }}
                    </div> -->

                    <form @submit.prevent="submit" class="flex flex-col w-90 gap-6">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input id="email" type="email" required autofocus :tabindex="1" autocomplete="email"
                                    v-model="form.email" class="border-blue-400" placeholder="email@domain.com" />
                                <InputError :message="form.errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="flex items-center justify-between">
                                    <Label for="password">Password</Label>
                                    <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm"
                                        :tabindex="5">
                                        Forgot password?
                                    </TextLink>
                                </div>
                                <Input id="password" type="password" required :tabindex="2"
                                    autocomplete="current-password" v-model="form.password" placeholder="Password"
                                    class="border-blue-400 " />
                                <InputError :message="form.errors.password" />
                            </div>

                            <!-- <div class="grid grid-cols-1 gap-2">
                                <div class="flex flex-col gap-2 w-full">
                                    <Label for="branch">Branch</Label>
                                    <SelectDropdown :options="branches" :label="'Branch'" v-model="form.branch" disabled/>
                                </div>
                            
                                <InputError :message="form.errors.branch" />
                            </div> -->

                            <div class="flex items-center justify-between">
                                <Label for="remember" class="flex items-center space-x-3">
                                    <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                                    <span>Remember me</span>
                                </Label>
                            </div>


                            <Button @click="submit" type="submit" class="mt-4 w-full bg-blue hover:bg-blue-800"
                                :tabindex="4" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Log in
                            </Button>
                        </div>

                        <!-- <div class="text-center text-sm text-muted-foreground">
                            Don't have an account?
                            <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="overflow-hidden hidden lg:block">
                <img src="images/background.jpg" alt="Image" class="object-cover w-full h-full hidden lg:block" />
            </div>
        </div>
    </AuthBase>

</template>


<style scoped>
.custom-shape-divider-top-1756522548 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    /* transform: rotate(180deg); */
    pointer-events: none;

}

.custom-shape-divider-top-1756522548 svg {
    position: relative;
    display: block;
    width: calc(197% + 1.3px);
    height: 100vh;
    z-index: auto;
    overflow: hidden;
}

.custom-shape-divider-top-1756522548 .shape-fill {
    fill: #2563eb;
    opacity: 0.1;
    z-index: -1
}
</style>
