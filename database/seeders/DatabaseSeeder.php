<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'angeligarciamd1@gmail.com'],
            [
                'name' => 'Angeli Garcia MD',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        $this->setupRolesAndPermissions();
    }

     protected function setupRolesAndPermissions() {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user1 = User::where(['name' => 'Angeli Garcia MD', 'is_admin' => true])->first();
        $user2 = User::where(['name' => 'admin', 'is_admin' => true])->first();
        /*
        |--------------------------------------------------------------------------
        | Define Permissions
        |--------------------------------------------------------------------------
        */
        $permissions = [
            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            // Roles
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',
            'roles.assign',
            'roles.remove',
            // assign permission to role
            'permissions.assign',
            'permissions.remove',
             // Branch
            'branches.view',
            'branches.create',
            'branches.edit',
            'branches.delete',
            // Reports
            'reports.sales.view',
            'reports.sales.export',  
            'reports.patients.view',
            'reports.patients.export',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        /*
        |--------------------------------------------------------------------------
        | Define Roles & Assign Permissions
        |--------------------------------------------------------------------------
        */
        $owner = Role::firstOrCreate(['name' => 'Owner']);
        $admin = Role::firstOrCreate(['name' => 'Administrator']);
        Role::firstOrCreate(['name' => 'Doctor']);
        Role::firstOrCreate(['name' => 'Cashier']);
        Role::firstOrCreate(['name' => 'Accounting']);
        Role::firstOrCreate(['name' => 'Inventory Manager']);
        Role::firstOrCreate(['name' => 'Secretary']);

        $owner->givePermissionTo(Permission::all());
        $admin->givePermissionTo(Permission::all());
        // 
        $user1->assignRole($owner);
        $user2->assignRole($admin);

    }
}
