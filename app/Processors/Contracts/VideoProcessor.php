<?php

namespace App\Processors\Contracts;

use App\Video;

interface VideoProcessor {

    public function process(Video $video);

}
