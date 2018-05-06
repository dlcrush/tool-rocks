<?php

namespace App;

class Page extends BaseModel
{
    protected $fillable = ['wp_id', 'title', 'slug', 'content', 'excerpt', 'published_at', 'modified_at', 'status', 'image'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'published_at', 'modified_at'];
}
