<?php

namespace App\Repositories;
use App\Repositories\Contracts\PageRepository as PageRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class PageRepository implements PageRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
        $apiKey = \Config::get('api.api_key');
        $this->urlBuilder->addParam('key', $apiKey);
    }

    public function getPages($options=[]) {

        $params = [];

        $url = $this->urlBuilder
            ->path('pages')
            ->params($params)
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getPage($id) {
        $url = $this->urlBuilder
            ->path('pages/' . $id)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
