<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Queue extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'patient_queueing';
    protected $primaryKey = 'queue_id';
    protected $guarded = [];

    protected $fillable = [
        'patient_id', 'branch_id', 'status',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}
