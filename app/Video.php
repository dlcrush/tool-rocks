<?php

namespace App;

class Video extends BaseModel
{
    protected $fillable = ['name', 'slug', 'description', 'video_id', 'source', 'band_id', 'published_at', 'thumbs_up', 'thumbs_down', 'date', 'duration', 'channel_id', 'channel_name', 'meta_title', 'meta_description', 'meta_keywords', 'unlisted'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at', 'date'];

    public function band() {
      return $this->belongsTo('App\Band');
    }

    public function songs() {
      return $this->belongsToMany('App\Song', 'videos_songs')->withPivot('order', 'start_time', 'end_time')->orderBy('order');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'videos_tags')->orderBy('name');
    }

    public function images() {
        return $this->hasMany('App\VideoImage');
    }
}
