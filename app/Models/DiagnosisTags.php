<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisTags extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'diagnosis_tags';
    protected $guarded = [];

}
