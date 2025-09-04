<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DermatologyDiagnosis extends Model
{

    use softDeletes;

    protected $table = 'dermatology_diagnoses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'symptoms',
    ];
    
}
