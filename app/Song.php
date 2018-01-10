<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends BaseModel
{
    protected $fillable = ['name', 'slug', 'band_id', 'has_lyrics', 'lyrics', 'lyrics_video_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function band() {
      return $this->belongsTo('App\Band');
    }

    public function albums() {
      return $this->belongsToMany('App\Album', 'songs_albums')->withPivot('order', 'is_hidden')->orderBy('albums.release_date');
    }

    public function video() {
        return $this->hasOne('App\Video', 'id', 'lyrics_video_id');
    }
}
