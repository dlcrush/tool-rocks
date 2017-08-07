<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ipsum extends Model
{
    use SoftDeletes;

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
