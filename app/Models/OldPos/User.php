<?php

namespace App\Models\OldPos;

use Illuminate\Database\Eloquent\Model;
use App\Models\OldPos\Therapist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    protected $connection = 'dc_pos';
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function therapist() : BelongsTo
    {
        return $this->belongsTo(Therapist::class, );
    }

}
