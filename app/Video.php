<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'video_id', 'source', 'band_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function band() {
      return $this->belongsTo('App\Band');
    }

    public function songs() {
      return $this->belongsToMany('App\Song', 'videos_songs')->withPivot('order', 'start_time', 'end_time')->orderBy('order');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag', 'videos_tags');
    }
}
