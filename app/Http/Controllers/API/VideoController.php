<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\VideoTransformer;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\YouTubeRepository;
use Illuminate\Database\DatabaseManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\Videos\ByTags;

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
        if (\Request::has('tags')) {
            $this->videoRepo->pushCriteria(new ByTags(explode(",", \Request::get('tags'))));
        }
        $paginator = $this->videoRepo->paginate(10);
        $videos = $paginator->getCollection();
        $videoIds = $videos->pluck('video_id')->toArray();
        $videosData = $this->youTubeRepo->getVideos(['id' => implode(',', $videoIds)], ['includeChannel' => true]);
        for($i = 0; $i < sizeof($videosData); $i ++) {
            $videos[$i]->youTubeData = $videosData[$i];
        }

        $videos = fractal()
           ->collection($videos)
           ->transformWith($this->videoTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($paginator))
           ->parseIncludes(['tags', 'channel'])
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
        $tagsIds = $video->tags->pluck('id');
        $videoIds = $this->db->table('videos_tags')
            ->whereIn('tag_id', $tagsIds)
            ->join('videos', 'videos_tags.video_id', '=', 'videos.id')
            ->select('videos.id')
            ->where('videos.id', '<>', $video->id)
            ->inRandomOrder()
            ->groupBy('videos.id')
            ->take(5)
            ->get()
            ->pluck('id');

        $videos = $this->videoRepo->findIn('id', $videoIds);
        $videosData = $this->youTubeRepo->getVideos(['id' => implode(',', $videos->pluck('video_id')->toArray())]);

        $related = array();
        for($i = 0; $i < sizeof($videos); $i ++) {
            $video = $videos[$i];
            $videoData = $videosData[$i];
            $video->youTubeData = $videoData;
            array_push($related, $video);
        }

        return $related;
    }

}
