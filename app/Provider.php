<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = []; 

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
