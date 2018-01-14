<?php

namespace App;

class Show extends BaseModel
{
    protected $fillable = ['name', 'slug', 'video_id', 'tour_id', 'venue_id', 'date'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'date'];

    public function tour() {
      return $this->belongsTo('App\Tour');
    }

    public function songs() {
      return $this->belongsToMany('App\Song', 'songs_shows')->withPivot('order', 'start_time', 'end_time', 'video_id')->orderBy('order');
    }

    public function video() {
        return $this->belongsTo('App\Video');
    }
}
