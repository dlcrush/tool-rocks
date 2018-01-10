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

    public function getVideos($options=array()) {
        $params = [];

        if (array_has($options, 'page')) {
            $params['page'] = array_get($options, 'page');
        }
        if (array_has($options, 'tags')) {
            $params['tags'] = array_get($options, 'tags');
        }
        if (array_has($options, 'year')) {
            $params['year'] = array_get($options, 'year');
        }
        if (array_has($options, 'type')) {
            $params['type'] = array_get($options, 'type');
        }

        $url = $this->urlBuilder
            ->path('videos')
            ->params($params)
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
