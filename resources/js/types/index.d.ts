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
    is_admin: boolean;
    is_active: boolean;
    email_verified_at: string | null;
    created_at: string;
    deleted_at: string | null;
    role?: Role;
    branches?: Branch[];
    therapist?: Therapist;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Patient {
    patient_id: number;
    gender: string;
    address: string;
    civil_status?: string;
    contact_number?: string;
    md_assigned?: number;
    fullName?: string;
    birthdate?: string;
    email_address?: string;
    source?: string;
    diagnosis?: Diagnosis[];
    md?: Employee;
    treatments?: Treatment[];
    dermatologyDiagnosis?: DermatologyDiagnosis[];
}

export interface Diagnosis {
    diagnosis_id: number;
    transaction_date: string;
    patient_id: Patient;
    patient_id: number;
    diagnosis: string;  
    created_by: Employee;
    user: User;
}

export interface DermatologyDiagnosis {
    id: number;
    name: string;
    description: string;
    symptoms: string;
}

export interface Employee {
    id: number;
    name: string;
    type: string;
    is_active: boolean;
    deleted_at: string;
}

export interface Treatment {
    treatment_id: number;
    transaction_date: string;
    patient_id: number;
    treatment: string;
    date: string;
    disposition: string;
    disposition_date: string;
    user: User;
}

export interface Branch {
    id: number;
    name: string;
    location: string;
    contact_number: string;
    is_active: boolean;
    avatar?: string;
}

export interface Role {
    id: number;
    name: string;
    users_count?: number;
    users?: User[];
    permissions?: Permission[]
}

export interface Permission {
    id: number;
    name: string;
    label: string;
    guard_name: string;
}

export interface Sale {
    id: number;
    total: number;
    date_created: string;
    branch_id: number;
    branch: Branch;
    user: User;
    patient: string | null;
    patient_id: number | null;
    patient?: Patient | null;
    created_by: User;
    items: SaleItem[];
}

export interface SaleItem {
    sales_line_item_id: number;
    sales_id: number;
    product_id: number;
    quantity: number;
    price: number;
    cost: number;
    subtotal: number;
    product?: Product;
    discount: number;
}

// export interface Product {
//     id: number;
//     product_name: string;
//     description: string;
//     price: number;
//     stock: number;
//     is_active: boolean;
//     category?: Category;
//     stock?: Stock[];
// }

// export interface Category {
//     id: number;
//     name: string;
//     description?: string;
//     is_active: boolean;
// }

// export interface Therapist {
//     id: number;
//     name: string;
//     specialty?: string;
//     contact_number?: string;
//     email?: string;
// }

// export interface SalesReportFilters {
//     start_date?: string;
//     end_date?: string;
//     user?: User;
//     branch?: Branch;
// }