<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function band() {
      return $this->belongsTo('App\Band');
    }
    
    public function albums() {
      return $this->belongsToMany('App\Album', 'songs_albums')->withPivot('order', 'is_hidden')->orderBy('albums.release_date');
    }
}
