<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $guarded = [];

    public function category() : BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function sales() : HasMany
    {
        return $this->hasMany(LineItem::class, 'product_id');
    }

    public function stock() : HasMany
    {
        return $this->hasMany(Stock::class, 'product_id');
    }


}
