<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'meta_title', 'meta_desc', 'meta_keyword', 'publish', 'highlight']; 

    public function product()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
    
}
