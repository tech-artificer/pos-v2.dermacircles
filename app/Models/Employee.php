<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Patient\Diagnosis;

class Employee extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'therapist';
    protected $primaryKey = 'therapist_id';
    protected $guarded = [];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function diagnosis() : HasMany
    {
        return $this->hasMany(Diagnosis::class, 'created_by');
    }

    public function patients() : HasMany
    {
        return $this->hasMany(Patient::class, 'md_assigned');
    }
}
