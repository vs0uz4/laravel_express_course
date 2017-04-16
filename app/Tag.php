<?php

namespace MyBlog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var Fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(){
        return $this->belongsToMany('MyBlog\Post', 'posts_tags');
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
}
