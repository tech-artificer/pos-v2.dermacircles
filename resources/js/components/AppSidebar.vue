<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { UserCog, LayoutGrid, ChartNoAxesCombined, KeySquare, Tags } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';


const page = usePage();

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
        hasSubItems: false,
        isActive: page.url.startsWith('/dashboard'),
    },
    // {
    //     title: 'Patient Management',
    //     href: '---',
    //     icon: UserCog,
    //     isActive: page.url.startsWith('/patients'),
    //     hasSubItems: false,
    // },
    {
        title: 'User Management',
        href: '/users',
        icon: UserCog,
        isActive: page.url.startsWith('/users'),
        hasSubItems: false,
    },
];

const reportNavItems: NavItem[] = [
    {
        title: 'Reports',
        href: '/reports',
        icon: ChartNoAxesCombined,
        isActive: page.url.startsWith('/reports'),
        hasSubItems: false,
        items: [
            {
                title: 'Sales',
                href: '/reports/sales',
                icon: KeySquare,
                isActive: page.url.startsWith('/reports/sales'),
            },
        ],
    },
];

const adminNavItems: NavItem[] = [
    // {
    //     title: 'Employees',
    //     href: '#',
    //     icon: Tags,
    // },
    {
        title: 'Accessibility',
        href: '/accessibility',
        icon: Tags,
        isActive: page.url.startsWith('/accessibility'),
    },
    // {
    //     title: 'Branches',
    //     href: '#',
    //     icon: Tags,
    // },
];

const dataNavItems: NavItem[] = [
    {
        title: 'Diagnosis Tags',
        href: '#',
        icon: Tags,
    },
];


</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" type="Main" />
            <NavMain :items="reportNavItems" type="Reports" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="adminNavItems" type="Administration" />
            <!-- <NavFooter :items="dataNavItems" type="Master Data" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
