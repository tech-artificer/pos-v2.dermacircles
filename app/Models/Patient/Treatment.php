<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OldPos\User as OldPosUser;

class Treatment extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'patient_treatment';
    protected $primaryKey = 'treatment_id';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(OldPosUser::class, 'created_by');
    }
}
