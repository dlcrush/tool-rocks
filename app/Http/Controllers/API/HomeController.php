<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\VideoTransformer;
use App\Transformers\PageTransformer;
use App\Transformers\PostTransformer;
use App\Repositories\API\Contracts\PageRepository;
use App\Repositories\API\Contracts\PostRepository;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\OrderBy;
use App\Repositories\API\Criteria\Not;
use App\Repositories\API\Criteria\NotNull;
use App\Repositories\API\Criteria\Filter;
use App\Repositories\API\Criteria\Take;

class HomeController extends APIController
{
    protected $videoRepo;
    protected $pageRepo;
    protected $postRepo;

    public function __construct(VideoRepository $videoRepo, PageRepository $pageRepo, PostRepository $postRepo, VideoTransformer $videoTransformer, PageTransformer $pageTransformer, PostTransformer $postTransformer) {
        $this->videoRepo = $videoRepo;
        $this->pageRepo = $pageRepo;
        $this->postRepo = $postRepo;
        $this->videoTransformer = $videoTransformer;
        $this->pageTransformer = $pageTransformer;
        $this->postTransformer = $postTransformer;
    }

    public function getHome() {
        $latestVideos = $this->getVideos();
        $latestNews = $this->getPosts();
        $welcome = $this->getWelcome();

        return $this->respond([
            'latestVideos' => $latestVideos,
            'latestNews' => $latestNews,
            'welcome' => $welcome
        ]);
    }

    private function getVideos() {
        $this->videoRepo->pushCriteria(new Expand(['images']));
        $this->videoRepo->pushCriteria(new NotNull(['views']));
        $this->videoRepo->pushCriteria(new Not('unlisted', true));
        $this->videoRepo->pushCriteria(new OrderBy('created_at', 'desc'));
        $this->videoRepo->pushCriteria(new Take(4));

        $videos = $this->videoRepo->all();

        $videos = fractal()
           ->collection($videos)
           ->transformWith($this->videoTransformer)
           ->toArray();

        return $videos;
    }

    public function getPosts() {
        $this->postRepo->pushCriteria(new Filter('status', 'publish'));
        $this->postRepo->pushCriteria(new OrderBy('published_at', 'desc'));
        $this->postRepo->pushCriteria(new Take(3));

        $posts = $this->postRepo->all();

        $posts = fractal()
           ->collection($posts)
           ->transformWith($this->postTransformer)
           ->toArray();

        return $posts;
    }

    public function getWelcome() {
        $page = fractal()
            ->item($this->pageRepo->findByIdOrSlug('welcome'))
            ->transformWith($this->pageTransformer)
            ->toArray();

        return $page;
    }
}
