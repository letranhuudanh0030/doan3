<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $guarded = []; 

    public function article()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
