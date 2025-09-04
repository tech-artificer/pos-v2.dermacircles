// --- Lists (centralized enums/constants) ---
export const roles = [
  { value: 'admin', label: 'Administrator' },
  { value: 'manager', label: 'Manager' },
  { value: 'staff', label: 'Staff' },
  { value: 'customer', label: 'Customer' },
  { value: 'customer', label: 'Owner' },
];

// export const statuses = [
//   { value: 'active', label: 'Active' },
//   { value: 'inactive', label: 'Inactive' },
//   { value: 'pending', label: 'Pending' },
//   { value: 'suspended', label: 'Suspended' },
// ]; 

export const genrders = [
  { value: 'male', label: 'Male' },
  { value: 'female', label: 'Female' },
  { value: 'others', label: 'Others' },
]; 

export const civil_status = [
  { value: 'single', label: 'Single' },
  { value: 'married', label: 'Married' },
  { value: 'Widowed', label: 'Widowed' },
  { value: 'divorced', label: 'Divorced' },
  { value: 'separated', label: 'Separated' },
];  

export const referrals = [
  { value: 'social media', label: 'Social Media' },
  { value: 'walk in', label: 'Walk In' },
  { value: 'advertising', label: 'Advertising' },
  { value: 'family and friends', label: 'Family and Friends' },
  { value: 'company employee', label: 'Company Employee' },
  { value: 'client (current, past)', label: 'Client (Current, Past)' },
];  

export function useData() {
  return {
    roles,
    civil_status,
    referrals,
  };
}