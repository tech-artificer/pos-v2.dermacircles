import { Ref } from "vue";
import { z } from 'zod';

// export interface Branch {
//     id: number;
//     name: string;

// }

// export interface User {
//     id: number;
//     name: string;
//     email: string;
//     is_active: boolean;
//     role: RouteList;

// }

// export const userSchema = z.object({
//     id: z.number(),
//     name: z.string(),
//     email: z.string(),
//     is_active: z.boolean(),
//     role: z.string(),
// })

// export type User = z.infer<typeof userSchema>

// export interface Role {
//     id: number;
//     name: string;
// }

// export const roleSchema = z.object({
//     id: z.number(),
//     name: z.string(),
// })

// export type Role = z.infer<typeof roleSchema>

export const userSchema = z.object({
    id: z.number(),
    name: z.string(),
    email: z.string(),
    avatar: z.optional(z.string()),
    is_admin: z.boolean(),
    is_active: z.boolean(),
    email_verified_at: z.optional(z.string()),
    created_at: z.string(),
    deleted_at: z.optional(z.string()),
    role?: z.optional(roleSchema),
    branch?: z.optional(z.array(branchSchema)),
})

export type User = z.infer<typeof userSchema>

export const patientSchema = z.object({
    patient_id: z.number(),
    gender: z.string(),
    address: z.string(),
    civil_status: z.optional(z.string()),
    contact_number: z.optional(z.string()),
    md_assigned: z.optional(z.number()),
    fullName: z.optional(z.string()),
    birthdate: z.optional(z.string()),
    email_address: z.optional(z.string()),
    source: z.optional(z.string()),
    diagnosis: z.array(diagnosisSchema),
    md: z.optional(employeeSchema),
    treatments: z.optional(z.array(treatmentSchema)),
})

export type Patient = z.infer<typeof patientSchema>

export const diagnosisSchema = z.object({
    diagnosis_id: z.number(),
    transaction_date: z.string(),
    patient_id: z.number(),
    diagnosis: z.string(),
    created_by: employeeSchema,
})

export type Diagnosis = z.infer<typeof diagnosisSchema>

export const employeeSchema = z.object({
    id: z.number(),
    name: z.string(),
    type: z.string(),
    is_active: z.boolean(),
    deleted_at: z.optional(z.string()),
})

export type Employee = z.infer<typeof employeeSchema>


export const treatmentSchema = z.object({
    treatment_id: z.number(),
    transaction_date: z.string(),
    patient_id: z.number(),
    treatment: z.string(),
    date: z.string(),
    disposition: z.string(),
    disposition_date: z.string(),
    created_by: employeeSchema,
})

export type Treatment = z.infer<typeof treatmentSchema>

export const branchSchema = z.object({
    id: z.number(),
    name: z.string(),
    location: z.string(),
    deleted_at: z.optional(z.string()),
})

export type Branch = z.infer<typeof branchSchema>

export const roleSchema = z.object({
    id: z.number(),
    name: z.string(),
    permissions: z.array(permissionSchema),
    deleted_at: z.optional(z.string()),
})

export type Role = z.infer<typeof roleSchema>

export const permissionSchema = z.object({
    id: z.number(),
    name: z.string(),
})

export type Permission = z.infer<typeof permissionSchema>
