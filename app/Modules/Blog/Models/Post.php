<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany('App\Modules\Blog\Models\Categories', 'post_cates', 'post_id', 'cate_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Modules\Blog\Models\User', 'user_id', 'id');
    }
}
