<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePackage extends Model
{
    protected $table = 'service_package';
    protected $primaryKey = 'service_package_id';

    public function services() : HasMany
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}
