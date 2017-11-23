<?php

namespace App\Repositories;
use App\Repositories\Contracts\VideoRepository as VideoRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class VideoRepository implements VideoRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
    }

    public function getVideo($id) {
        $url = $this->urlBuilder
            ->path('videos/'.$id)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getVideos() {

    }

}
