<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'branch_name',
        'location',
        'active',
        'contact_number',
    ];
    /**
     * The users that belong to the branch.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_branches');
    }


    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }
}
