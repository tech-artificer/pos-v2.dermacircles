<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'category_id';
    protected $guarded = [];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
