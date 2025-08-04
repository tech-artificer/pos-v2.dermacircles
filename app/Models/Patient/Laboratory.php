<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laboratory extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'patient_laboratory';
    protected $primaryKey = 'laboratory_id';
    protected $guarded = [];

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

}
