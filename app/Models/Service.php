<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'services';
    protected $primaryKey = 'service_id';


    public function package(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class);
    }

     public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

}
