import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
    hasSubItems?: boolean;
    items?: NavSubItem[];
}

export interface NavSubItem {
    title?: string;
    href?: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Patient {
    patient_id: number;
    gender: string;
    address: string;
    civil_status: string;
    contact_number: string;
    md_assigned: number;
    fullName: string;
    birthdate: string;
    email_address?: string;
    source: string;
    diagnosis: Diagnosis[];
    md: Employee;
    treatments?: Treatment[];  
}

export interface Diagnosis {
    diagnosis_id: number;
    transaction_date: string;
    patient_id: Patient;
    patient_id: number;
    diagnosis: string;
    created_by: Employee;
}

export interface Employee {
    id: number;
    name: string;
    type: string;
    status: string;
}

export interface Treatment {
    treatment_id: number;
    transaction_date: string;
    patient_id: number;
    treatment: string;
    date: string;
    disposition: string;
    disposition_date: string;
    created_by: Employee;
}
