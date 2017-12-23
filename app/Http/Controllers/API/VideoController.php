<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\VideoTransformer;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\YouTubeRepository;

class VideoController extends APIController
{

    protected $videoRepo;
    protected $youTubeRepo;

    public function __construct(VideoRepository $videoRepo, YouTubeRepository $youTubeRepo, VideoTransformer $videoTransformer) {
        $this->videoRepo = $videoRepo;
        $this->youTubeRepo = $youTubeRepo;
        $this->videoTransformer = $videoTransformer;
    }

    public function getVideos() {

        $videos = fractal()
           ->collection($this->videoRepo->all())
           ->transformWith($this->videoTransformer)
           ->parseIncludes('')
           ->toArray();

        return $this->respond($videos);
    }

    public function getVideo($id) {
        $video = $this->videoRepo->find($id);

        $videoData = $this->youTubeRepo->getVideo(['id' => $video->video_id]);

        $video->youTubeData = $videoData;

        //print_r($videoData);

        $video = fractal()
           ->item($video)
           ->transformWith($this->videoTransformer)
           ->parseIncludes(['channel', 'songs'])
           ->toArray();

        return $this->respond($video);
    }

}
