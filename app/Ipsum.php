<?php

namespace App;

class Ipsum extends BaseModel
{
    protected $fillable = ['content', 'band_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function band() {
      return $this->hasMany('App\Band');
    }

}
