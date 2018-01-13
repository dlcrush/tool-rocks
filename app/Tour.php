<?php

namespace App;

class Tour extends BaseModel
{
    protected $fillable = ['name', 'slug', 'description', 'video_id', 'source', 'band_id', 'published_at', 'thumbs_up', 'thumbs_down', 'date'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'date'];

    public function band() {
      return $this->belongsTo('App\Band');
    }

    public function shows() {
      return $this->hasMany('App\Show')->orderBy('date');
    }
}
