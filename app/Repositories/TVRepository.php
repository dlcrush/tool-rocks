<?php

namespace App\Repositories;
use App\Repositories\Contracts\TVRepository as TVRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class TVRepository implements TVRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
    }

    public function getTV() {
        $url = $this->urlBuilder
            ->path('tv')
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
