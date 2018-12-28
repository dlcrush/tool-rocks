<?php

namespace App\Processors\Contracts;

use App\Video;

interface PostProcessor {

    public function process(Video $video);

}
