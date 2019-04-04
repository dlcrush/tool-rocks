<?php

namespace App;

class Maynardism extends BaseModel
{
    protected $fillable = ['content', 'video_id'];

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
