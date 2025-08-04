<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingServiceTransaction extends Model
{
    protected $table = 'billing_service_transaction';
    protected $primaryKey = 'billing_service_transaction_id';
    public $timestamps = false; 

    public function billing() : BelongsTo
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'billing_id');
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

}
