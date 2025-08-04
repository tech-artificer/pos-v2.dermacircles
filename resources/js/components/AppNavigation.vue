<script setup lang="ts">
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu'

const salesReports: { title: string, href: string, description: string }[] = [
  {
    title: 'Sales Summary',
    href: '/reports/sales/summary',
    description:
      'A modal dialog that interrupts the user with important content and expects a response.',
  },
  {
    title: 'Sales by Product/Service',
    href: '/docs/components/hover-card',
    description:
      'For sighted users to preview content available behind a link.',
  },
  {
    title: 'Sales by Category',
    href: '/docs/components/progress',
    description:
      'Displays an indicator showing the completion progress of a task, typically displayed as a progress bar.',
  },
  {
    title: 'Sales by Branch',
    href: '/docs/components/scroll-area',
    description: 'Visually or semantically separates content.',
  },
]

const patientReports: { title: string, href: string, description: string }[] = [
  {
    title: 'Patient Demographics',
    href: '/reports/patients/demographics',
    description:
      'Provide insights into patient demographics such as age, gender, and marital status.',
  },
  {
    title: 'Patient Visit History',
    href: '/reports/patients/visit-history',
    description:
      'Provides a comprehensive overview of patient visit history, including dates, reasons for visits, and outcomes.',
  },
  {
    title: 'Patient Diagnosis',
    href: '/reports/patients/diagnosis',
    description:
      'Provides a detailed analysis of patient diagnoses, including their frequency and impact on patient outcomes.',
  },
 
]

const billingReports: { title: string, href: string, description: string }[] = [
  {
    title: 'Billing Summary',
    href: '/reports/billing/summary',
    description:
      'A modal dialog that interrupts the user with important content and expects a response.',
  },
  {
    title: 'Services Billed',
    href: '/reports/billing',
    description:
      'For sighted users to preview content available behind a link.',
  },
  {
    title: 'Revenue Report',
    href: '/reports/billing/revenue',
    description:
      'For sighted users to preview content available behind a link.',
  },
 
]
</script>

<template>
  <NavigationMenu>
    <NavigationMenuList>
      <NavigationMenuItem>
        <NavigationMenuTrigger>Patient Reports</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[minmax(0,.75fr)_minmax(0,1fr)]">
            <li v-for="patientReport in patientReports" :key="patientReport.title">
              <NavigationMenuLink as-child>
                <a
                  :href="patientReport.href"
                  class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                >
                  <div class="text-sm font-medium leading-none">{{ patientReport.title }}</div>
                  <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                   {{ patientReport.description }}
                  </p>
                </a>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuTrigger>Billing Reports</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul class="grid gap-3 p-6 md:w-[400px] lg:w-[500px] lg:grid-cols-[minmax(0,.75fr)_minmax(0,1fr)]">
            <li v-for="billingReport in billingReports" :key="billingReport.title">
              <NavigationMenuLink as-child>
                <a
                  href="/docs/introduction"
                  class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                >
                  <div class="text-sm font-medium leading-none">{{ billingReport.title }}</div>
                  <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                    Re-usable components built using Radix UI and Tailwind CSS.
                  </p>
                </a>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuTrigger>Sales Reports</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px] ">
            <li v-for="salesReport in salesReports" :key="salesReport.title">
              <NavigationMenuLink as-child>
                <a
                  :href="salesReport.href"
                  class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                >
                  <div class="text-sm font-medium leading-none">{{ salesReport.title }}</div>
                  <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                    {{ salesReport.description }}
                  </p>
                </a>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
      <!-- <NavigationMenuItem>
        <NavigationMenuLink href="/docs/introduction" :class="navigationMenuTriggerStyle()">
          Products
        </NavigationMenuLink>
      </NavigationMenuItem> -->
    </NavigationMenuList>
  </NavigationMenu>
</template>