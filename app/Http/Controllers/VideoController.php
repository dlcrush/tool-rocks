<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\VideoRepository;
use App\Repositories\Contracts\BandRepository;

class VideoController extends Controller
{
    protected $videoRepo;

    public function __construct(VideoRepository $videoRepo, BandRepository $bandRepo) {
        $this->videoRepo = $videoRepo;
        $this->bandRepo = $bandRepo;
    }

    public function getVideo($id, $slug='') {
        $video = $this->videoRepo->getVideo($id);

        return view('videos.show', compact('video'));
    }

    public function getVideos() {
        $params = [];
        if (\Request::has('tags')) {
            $params['tags'] = \Request::get('tags');
        }
        if (\Request::has('year')) {
            $params['year'] = \Request::get('year');
        }
        if (\Request::has('type')) {
            $params['type'] = \Request::get('type');
        }
        if (\Request::has('page')) {
            $params['page'] = \Request::get('page');
        }
        if (\Request::has('orderBy')) {
            $params['orderBy'] = \Request::get('orderBy');
        }

        $videos = $this->videoRepo->getVideos($params);
        $tags = [];
        for($i = 2018; $i > 1990; $i --) {
            array_push($tags, ['id' => $i, 'year' => $i]);
        }

        $page = \Request::get('page');
        $year = \Request::get('year');
        $type = \Request::get('type');
        $orderBy = \Request::get('orderBy');

        return view('videos.index', compact('videos', 'tags', 'page', 'year', 'type', 'orderBy'));
    }

    public function getSearch() {
        $searchCriteria = [];
        $year = null;
        $text = null;
        $type = null;
        $songs = null;
        $tags = null;

        if (\Request::has('text')) {
           $searchCriteria['text'] = \Request::get('text');
        }
        if (\Request::has('page')) {
            $searchCriteria['page'] = \Request::get('page');
        }
        if (\Request::has('tags')) {
            $searchCriteria['tags'] = \Request::get('tags');
        }
        if (\Request::has('year')) {
            $searchCriteria['year'] = \Request::get('year');
        }
        if (\Request::has('songs')) {
            $searchCriteria['songs'] = \Request::get('songs');
        }
        if (\Request::has('type')) {
            $searchCriteria['type'] = \Request::get('type');
        }

        $allSongs = $this->bandRepo->getSongs('tool');

        $years = [];
        for($i = 2018; $i > 1990; $i --) {
            array_push($years, ['id' => $i, 'year' => $i]);
        }

        if (count($searchCriteria) > 0) {
            $videos = $this->videoRepo->searchVideos($searchCriteria);

            $text = isset($searchCriteria['text']) ? $searchCriteria['text'] : null;
            $year = isset($searchCriteria['year']) ? $searchCriteria['year'] : null;
            $type = isset($searchCriteria['type']) ? $searchCriteria['type'] : null;
            $songs = isset($searchCriteria['songs']) ? explode(",", $searchCriteria['songs']) : null;
            $tags = isset($searchCriteria['tags']) ? $searchCriteria['tags'] : null;

            return view('videos.search', compact('videos', 'text', 'years', 'year', 'allSongs', 'songs', 'type', 'tags'));
        }

        return view('videos.search', compact('years', 'allSongs', 'year', 'type', 'songs'));
    }

    public function getRandomVideo() {
        $video = $this->videoRepo->getRandomVideo();

        return redirect()->action('VideoController@getVideo', ['id' => array_get($video, 'id'), 'slug' => array_get($video, 'slug')]);
    }

    public function getDailyFix() {
        $videos = array_get($this->videoRepo->getDailyFix(), 'data');

        return view('dailyfix.videos', compact('videos'));
    }
}
