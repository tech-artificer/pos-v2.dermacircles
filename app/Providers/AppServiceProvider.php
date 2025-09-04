<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use App\Models\Branch;
use App\Models\DermatologyDiagnosis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Roles & Permissions (moved to dedicated private method for clarity)
        $this->shareRolesAndPermissions();
    }

    private function shareRolesAndPermissions(): void
    {

        $branches = Branch::all();
        $dermatologyDiagnosis = DermatologyDiagnosis::all();
    
        $roles = Role::with(['permissions'])->withCount('users')->get(['id', 'name']);
        
        $allPermissions = Permission::all()->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name, // keep original for saving
                'label' => $this->humanizePermission($p->name),
            ];
        });

        $groupedPermissions = $allPermissions->groupBy(fn ($permission) => explode('.', $permission['name'])[0])
            ->map(fn ($group) => $group->values());

        $assignedPermissions = $roles->mapWithKeys(function ($role) {
            return [$role->name => $role->permissions->pluck('name')];
        });

        Inertia::share([
            'branches' => $branches,
            'dermatologyDiagnosis' => $dermatologyDiagnosis,
            'roles' => $roles,
            'permissions' => $allPermissions,
            'groupedPermissions' => $groupedPermissions,
            'assignedPermissions' => $assignedPermissions,
        ]);
    }

    protected function humanizePermission(string $name) : string
    {
        $parts = explode('.', $name);

        if (count($parts) === 3) {
            [$entity, $anotherEntity, $action] = $parts;
            return ucfirst($action) . ' ' . ucfirst($anotherEntity) . ' ' . ucfirst($entity);
        }

        if (count($parts) === 2) {
            [$entity, $action] = $parts;
            return ucfirst($action) . ' ' . ucfirst($entity);
        }

        // fallback: just prettify words
        return ucfirst(str_replace('.', ' ', $name));
    }
}
