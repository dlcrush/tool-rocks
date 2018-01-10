<?php

namespace App;

class Tag extends BaseModel
{
    protected $fillable = ['name', 'slug'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function videos() {
        return $this->belongsToMany('App\Video', 'videos_tags');
    }
}
