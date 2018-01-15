<?php

namespace App;

class TV extends BaseModel
{
    protected $table = 'tv';

    protected $fillable = ['video_id', 'playback_start_time', 'playback_end_time'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function video() {
      return $this->belongsTo('App\Video');
    }
}
