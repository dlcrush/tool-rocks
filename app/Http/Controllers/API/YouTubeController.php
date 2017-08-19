<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\YouTubeRepository;

class YouTubeController extends APIController
{

    protected $repo;

    public function __construct(YouTubeRepository $repo) {
        $this->repo = $repo;
    }

    public function getVideo($id)
    {
        $video = $this->repo->getVideo(['id' => $id]);

        return $video;
    }

    public function getVideos()
    {
        $videos = $this->repo->getVideos(['chart' => 'mostPopular', 'regionCode' => 'US']);

        return $videos;
    }

    public function getVideosByChannel($channelName)
    {
        $videos = $this->repo->getVideosByChannel($channelName);

        return $videos;
    }

    public function getChannel($id)
    {
        $channel = $this->repo->getChannelById($id);

        return $channel;
    }

}
