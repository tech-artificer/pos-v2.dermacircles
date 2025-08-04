<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class LineItem extends Model
{
    use HasFactory;

    protected $connection = 'dc_pos';
    protected $primaryKey = 'sales_line_item_id'; // Assuming this PK
    protected $table = 'sales_line_items';

    protected $fillable = [
        'sales_id', 'product_id', 'quantity', 'price_per_unit', 'total_price'
    ];

    public function sales() : BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}