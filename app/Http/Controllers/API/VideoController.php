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
use App\Repositories\API\Criteria\OrderBy;
use App\Repositories\API\Criteria\NotNull;
use App\Repositories\API\Criteria\Randomize;
use App\Repositories\API\Criteria\Take;
use App\Repositories\API\Criteria\Not;

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
        $orderBy = 'views:desc';
        if (\Request::has('tags')) {
            $searchCriteria['tags'] = \Request::get('tags');
        }
        if (\Request::has('year')) {
            $searchCriteria['year'] = \Request::get('year');
        }
        if (\Request::has('type')) {
            $searchCriteria['type'] = \Request::get('type');
        }
        if (\Request::has('orderBy')) {
            $orderBy = \Request::get('orderBy');
        }

        if (sizeof($searchCriteria) > 0) {
            $this->videoRepo->pushCriteria(new Search($searchCriteria));
        }

        $this->videoRepo->pushCriteria(new Expand(['images', 'tags']));
        $this->videoRepo->pushCriteria(new NotNull(['views']));
        $this->videoRepo->pushCriteria(new Not('unlisted', true));
        $orderBy = explode(':', $orderBy);
        $orderByProp = $orderBy[0];
        $orderByDirection = sizeof($orderBy) > 1 ? $orderBy[1] : 'asc';
        $this->videoRepo->pushCriteria(new OrderBy($orderByProp, $orderByDirection));

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

    public function searchVideos() {
        $this->videoRepo->pushCriteria(new Expand(['tags', 'images']));
        $this->videoRepo->pushCriteria(new NotNull(['views']));

        $orderBy = 'views:desc';
        $searchCriteria = [];

        if (\Request::has('text')) {
            $searchCriteria['text'] = \Request::get('text');
        }
        if (\Request::has('tags')) {
            $searchCriteria['tags'] = \Request::get('tags');
        }
        if (\Request::has('year')) {
            $searchCriteria['year'] = \Request::get('year');
        }
        if (\Request::has('type')) {
            $searchCriteria['type'] = \Request::get('type');
        }
        if (\Request::has('orderBy')) {
            $orderBy = \Request::get('orderBy');
        }

        if (sizeof($searchCriteria) > 0) {
            $this->videoRepo->pushCriteria(new Search($searchCriteria));
        }

        $orderBy = explode(':', $orderBy);
        $orderByProp = $orderBy[0];
        $orderByDirection = sizeof($orderBy) > 1 ? $orderBy[1] : 'asc';
        $this->videoRepo->pushCriteria(new OrderBy($orderByProp, $orderByDirection));

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

    public function getRelatedVideos(\App\Video $video) {

        $tagsIds = $video->tags->pluck('id');
        $videoIds = $this->db->table('videos_tags')
            ->whereIn('tag_id', $tagsIds)
            ->join('videos', 'videos_tags.video_id', '=', 'videos.id')
            ->select('videos.id')
            ->where('videos.id', '<>', $video->id)
            ->inRandomOrder()
            ->groupBy('videos.id')
            ->take(6)
            ->get()
            ->pluck('id');

        $this->videoRepo->reset(); // reset query and criteria
        $this->videoRepo->pushCriteria(new Expand(['images', 'tags']));
        $videos = $this->videoRepo->findIn('id', $videoIds);
        $this->videoRepo->reset();

        return $videos;
    }

    public function getRandomVideo() {
        $this->videoRepo->pushCriteria(new Expand(['tags', 'images']));
        $this->videoRepo->pushCriteria(new Randomize());
        $this->videoRepo->pushCriteria(new Take(1));

        $video = $this->videoRepo->all()->first();

        $video->channel = $this->youTubeRepo->getChannel(['id' => $video->channel_id]);
        $video->related = $this->getRelatedVideos($video);

        $video = fractal()
            ->item($video)
            ->transformWith($this->videoTransformer)
            ->parseIncludes(['channel', 'songs', 'tags', 'related'])
            ->toArray();

        return $this->respond($video);
    }

    public function getDailyFix() {
        $this->videoRepo->pushCriteria(new Expand(['tags', 'images']));

        $ids = $this->db->table('dailyfix')->select('video_id')->pluck('video_id');

        $videos = $this->videoRepo->findIn('id', $ids);

        $videos = fractal()
           ->collection($videos)
           ->transformWith($this->videoTransformer)
           ->toArray();

        return $this->respond($videos);
    }

}
