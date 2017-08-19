<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Video;

class VideoController extends APIController
{

    public function getVideos()
    {
        return Video::with('band')->with('songs')->get();
    }

}
