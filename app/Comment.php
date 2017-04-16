<?php

namespace MyBlog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var Fillable
     */
    protected $fillable = [
        'name',
        'email',
        'text',
        'confirmed',
        'post_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(){
        return $this->belongsTo('MyBlog\Post');
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
