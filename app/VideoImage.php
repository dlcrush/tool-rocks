<?php

namespace App;

class VideoImage extends BaseModel
{

    protected $table = 'video_images';

    protected $fillable = ['video_id', 'size', 'url', 'height', 'width'];

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
