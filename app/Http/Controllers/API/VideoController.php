<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\VideoTransformer;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\YouTubeRepository;
use Illuminate\Database\DatabaseManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\Videos\Search;

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
        $searchCriteria = [];
        if (\Request::has('tags')) {
            $searchCriteria['tags'] = \Request::get('tags');
        }
        if (\Request::has('year')) {
            $searchCriteria['year'] = \Request::get('year');
        }
        if (\Request::has('type')) {
            $searchCriteria['type'] = \Request::get('type');
        }

        if (sizeof($searchCriteria) > 0) {
            $this->videoRepo->pushCriteria(new Search($searchCriteria));
        }

        $this->videoRepo->pushCriteria(new Expand(['images', 'tags']));

        $paginator = $this->videoRepo->paginate(10);
        $videos = $paginator->getCollection();

        $videos = fractal()
           ->collection($videos)
           ->transformWith($this->videoTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($paginator))
           ->parseIncludes(['tags'])
           ->toArray();

        return $this->respond($videos);
    }

    public function getVideo($id) {
        $this->videoRepo->pushCriteria(new Expand(['tags', 'images']));

        $video = $this->videoRepo->find($id);

        $video->channel = $this->youTubeRepo->getChannel(['id' => $video->channel_id]);
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

        $this->videoRepo->reset(); // reset query and criteria
        $this->videoRepo->pushCriteria(new Expand(['images', 'tags']));
        $videos = $this->videoRepo->findIn('id', $videoIds);
        $this->videoRepo->reset();

        return $videos;
    }

}
