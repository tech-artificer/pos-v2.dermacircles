<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Sales extends Model
{
    use HasFactory;

    protected $connection = 'dc_pos';
    protected $primaryKey = 'sales_id';
    protected $table = 'sales'; // Explicitly define if not 'sales'

    protected $fillable = [
        'patient_id', 'total',
        'status', 'date_created', 'branch_id'
    ];

    public $timestamp = false;

    // Ensure timestamps are handled by Laravel if columns exist
    // public $timestamps = true; // Default true, but confirm columns exist

    public function patient() : BelongsTo
    {
        return $this->belongsTo(PatientInformation::class, 'patient_id');
    }

    public function lineItems() : HasMany
    {
        return $this->hasMany(SalesLineItem::class, 'sales_id');
    }

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function branch() : BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id' );
    }

    // --- Local Scope for Date Filtering ---
    public function scopeBetweenDates(Builder $query, $startDate, $endDate)
    {
        return $query->whereDate('date_created', '>=', $startDate)
                     ->whereDate('date_created', '<=', $endDate);
    }
}