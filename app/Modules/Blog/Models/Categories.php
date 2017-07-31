<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    public $timestamps = true;

    public function posts()
    {
    	return $this->belongsToMany('App\Modules\Blog\Models\Post', 'post_cates', 'cate_id', 'post_id');
    }
}
