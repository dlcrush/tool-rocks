<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\WordPressRepository as WordPressRepositoryInterface;
use App\Library\Http\UrlBuilder;
use App\Library\Http\Http;
use Illuminate\Support\Collection;

class WordPressRepository implements WordPressRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl('http://wp.toolrocks.com/toolrocks/wp-json/wp/v2/');
    }

    public function getPages($data=[]) {
        $url = $this->urlBuilder
            ->path('pages')
            ->params([])
            ->build();

        $response = json_decode($this->http->get($url));

        $pages = new Collection();

        return $response;
    }

    public function getPosts($data=[]) {
        $url = $this->urlBuilder
            ->path('posts?_embed')
            ->params([])
            ->build();

        $response = json_decode($this->http->get($url));

        $posts = new Collection();

        return $response;
    }
}
