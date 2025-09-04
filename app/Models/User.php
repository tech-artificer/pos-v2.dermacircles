<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;   
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $appends = ['role'];
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first(); // returns the first role or null
    }

    /**
     * The branches that belong to the user.
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'user_branches');
    }

    // public function branchRoles()
    // {
    //     return $this->belongsToMany(Role::class, 'branch_user_roles')
    //         ->withPivot('branch_id')
    //         ->withTimestamps();
    // }

    // public function hasRoleInBranch($roleName, $branchId)
    // {
    //     return $this->branchRoles()
    //         ->where('name', $roleName)
    //         ->wherePivot('branch_id', $branchId)
    //         ->exists();
    // }

    // public function scopeActive(Builder $query)
    // {
    //     return $query->where('is_active', true);
    // }
}
