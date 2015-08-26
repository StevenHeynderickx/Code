<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories()
    {
        return $this->morphToMany('App\Category', 'categorizable');
    }
    /**
     * No timestamps for this model
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * find all poses with the specified $id
     * @param $query
     * @param mixed $id int, string or array of ints and strings
     */
    public function scopeWithCategoryId($query, $id)
    {
        $query->with(['categories' => function ($q) use ($id) {
            $q->wherePivot('category_id', '=', $id);
        }])
            ->whereHas('categories', function ($q) use ($id) {
                $q->where('category_id', $id);
            })->with('categories');
    }
}
