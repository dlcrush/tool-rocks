<?php

namespace App\Repositories\API\Contracts;

interface YouTubeRepository {

    public function getVideo($data);

    public function getVideos($data);

}
