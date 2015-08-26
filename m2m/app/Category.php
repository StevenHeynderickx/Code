<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * No timestamps for this model
     *
     * @var bool
     */
    public $timestamps = false;
    //
    public function category()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_id')->orderBy('order', 'asc');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Post', 'categorizable');
    }
    public function fourPosts()
    {
        return $this->morphedByMany('App\Post', 'categorizable')->limit(4);
    }

}
