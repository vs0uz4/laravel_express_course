<?php

namespace MyBlog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function posts(){
        return $this->belongsToMany('MyBlog\Post', 'posts_tags');
    }
}
