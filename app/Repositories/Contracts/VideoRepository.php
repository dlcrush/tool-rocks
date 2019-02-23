<?php

namespace App\Repositories\Contracts;

interface VideoRepository {
    public function getVideo($id);
    public function getVideos($options);
    public function searchVideos($options);
}
