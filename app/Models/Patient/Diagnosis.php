<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Patient\Diagnosis;
use App\Models\Employee;

class Diagnosis extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'patient_diagnosis';
    protected $primaryKey = 'diagnosis_id';
    protected $guarded = [];
    protected $appends = ['md_assigned'];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function md() : BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    public function getMdAssignedAttribute()
    {
        return Employee::find($this->created_by);
    }


}
