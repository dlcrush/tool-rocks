<?php

namespace App\Repositories;
use App\Repositories\Contracts\MaynardismRepository as MaynardismRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class MaynardismRepository implements MaynardismRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
    }

    public function getMaynardisms() {
        $url = $this->urlBuilder
            ->path('maynardisms')
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
