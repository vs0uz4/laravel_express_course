<?php

namespace MyBlog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var Fillable
     */
    protected $fillable = [
        'author_id',
        'title',
        'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(){
        return $this->belongsTo('MyBlog\User', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('MyBlog\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
        return $this->belongsToMany('MyBlog\Tag', 'posts_tags');
    }

    /**
     * @return string
     */
    public function getTagListAttribute(){
        $tags = $this->tags()->lists('name')->all();

        return implode(', ', $tags);
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
