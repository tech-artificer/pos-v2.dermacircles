<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Patient\Diagnosis;
use App\Models\Patient\Treatment;
use App\Models\DermatologyDiagnosis;

class Patient extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'patient_information';
    protected $guarded = [];
    protected $primaryKey = 'patient_id';
    protected $appends = ['fullName', 'dermatologyDiagnosis'];

    public function getFullNameAttribute()
    {
        return "{$this->lastname}, {$this->firstname} {$this->middlename}";
    }

    public function diagnosis(): HasMany
    {
        return $this->hasMany(Diagnosis::class, 'patient_id');
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class, 'patient_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'patient_id');
    }

    public function billing(): HasMany
    {
        return $this->hasMany(Billing::class, 'patient_id');
    }

    public function md(): HasOne
    {
        return $this->hasOne(Employee::class, 'therapist_id', 'md_assigned');
    }

    public function getDermatologyDiagnosisAttribute()
    {
        $availableTags = DermatologyDiagnosis::pluck('name')->toArray();

        // Now, iterate through all of the patient's diagnosis records.
        return $this->diagnosis()->pluck('diagnosis')->flatMap(function ($diagnosisSentence) use ($availableTags) {
            // For each diagnosis sentence, find all matching tags.
            return collect($availableTags)->filter(function ($tag) use ($diagnosisSentence) {
                // Check if the diagnosis sentence contains the tag (case-insensitive).
                return str_contains(strtolower($diagnosisSentence), strtolower($tag));
            });
        })->unique()->values(); // Use flatMap to flatten the nested arrays and get unique tags.
    }

   
}
