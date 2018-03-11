<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\VideoRepository;

class VideoController extends Controller
{
    protected $videoRepo;

    public function __construct(VideoRepository $videoRepo) {
        $this->videoRepo = $videoRepo;
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
        return view('videos.search');
    }
}
