<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\VideoTransformer;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\YouTubeRepository;
use Illuminate\Database\DatabaseManager;

class VideoController extends APIController
{

    protected $videoRepo;
    protected $youTubeRepo;
    protected $videoTransformer;
    protected $db;

    public function __construct(VideoRepository $videoRepo, YouTubeRepository $youTubeRepo, VideoTransformer $videoTransformer, DatabaseManager $db) {
        $this->videoRepo = $videoRepo;
        $this->youTubeRepo = $youTubeRepo;
        $this->videoTransformer = $videoTransformer;
        $this->db = $db;
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

        $video->related = $this->getRelatedVideos($video);

        $video = fractal()
           ->item($video)
           ->transformWith($this->videoTransformer)
           ->parseIncludes(['channel', 'songs', 'tags', 'related'])
           ->toArray();

        return $this->respond($video);
    }

    public function getRelatedVideos(\App\Video $video) {
        $videoIds = $this->db->table('videos')
            ->where('band_id', $video->band_id)
            ->join('videos_tags', 'videos.id', '=', 'videos_tags.video_id')
            ->select('videos.id')
            ->groupBy('videos.id')
            ->inRandomOrder()
            ->take(5)
            ->get()
            ->pluck('id');

        $videos = array();
        foreach($videoIds as $videoId) {
            $video = $this->videoRepo->find($videoId);
            $videoData = $this->youTubeRepo->getVideo(['id' => $video->video_id]);
            $video->youTubeData = $videoData;
            array_push($videos, $video);
        }

        return $videos;
    }

}
