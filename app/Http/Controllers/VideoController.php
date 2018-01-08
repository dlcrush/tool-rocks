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
        $videos = $this->videoRepo->getVideos($params);
        $tags = [];
        for($i = 2017; $i > 1990; $i --) {
            array_push($tags, ['id' => $i, 'year' => $i]);
        }

        return view('videos.index', compact('videos', 'tags'));
    }
}
