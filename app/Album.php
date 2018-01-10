<?php

namespace App;

class Album extends BaseModel
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'released'];

    public function band() {
      return $this->belongsTo('App\Band');
    }

    public function songs() {
      return $this->belongsToMany('App\Song', 'songs_albums')->withPivot('order', 'is_hidden')->orderBy('order');
    }
}
