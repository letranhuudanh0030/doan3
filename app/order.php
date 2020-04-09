<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $guarded = []; 

    public function order_detail()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'qty', 'amount', 'data', 'status')->withTimestamps();
    }
}
