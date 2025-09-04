<?php

namespace App\Models\OldPos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\OldPos\User;
class Therapist extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'therapist';
    protected $primaryKey = 'therapist_id';
    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'employee_id', 'employee_id');
    }
}
