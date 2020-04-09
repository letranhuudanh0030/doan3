<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = []; 

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function order_detail()
    {
        return $this->belongsToMany(order::class);
    }

}
