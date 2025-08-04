<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Branch extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'branch';
    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'location',
        'active',
    ];

    // protected $hidden = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    // public function users() : BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'branch_user_roles')->withPivot('role_id')->withTimestamps();
    // }


    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
