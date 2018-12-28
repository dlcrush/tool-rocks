<?php

namespace App\Repositories;
use App\Repositories\Contracts\PostRepository as PostRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class PostRepository implements PostRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
    }

    public function getPosts($options=[]) {

        $params = [];

        if (array_has($options, 'page')) {
            $params['page'] = array_get($options, 'page');
        }

        $url = $this->urlBuilder
            ->path('posts')
            ->params($params)
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getPost($id) {
        $url = $this->urlBuilder
            ->path('posts/' . $id)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
