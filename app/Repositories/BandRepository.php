<?php

namespace App\Repositories;
use App\Repositories\Contracts\BandRepository as BandRepositoryInterface;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class BandRepository implements BandRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
    }

    public function getBand($bandIdOrSlug) {
        $url = $this->urlBuilder
            ->path('bands/'.$bandIdOrSlug)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getBands() {
        $url = $this->urlBuilder
            ->path('bands')
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getSong($bandIdOrSlug='tool', $songIdOrSlug) {
        $url = $this->urlBuilder
            ->path('bands/'.$bandIdOrSlug . '/songs/' . $songIdOrSlug)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getTours($bandIdOrSlug='tool') {
        $url = $this->urlBuilder
            ->path('bands/'. $bandIdOrSlug . '/tours')
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getTour($bandIdOrSlug='tool', $tourId) {
        $url = $this->urlBuilder
            ->path('bands/' . $bandIdOrSlug . '/tours/' . $tourId)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

    public function getShow($bandIdOrSlug='tool', $tourId, $showId) {
        $url = $this->urlBuilder
            ->path('bands/' . $bandIdOrSlug . '/tours/' . $tourId . '/shows/' . $showId)
            ->params([])
            ->build();

        return json_decode($this->http->get($url), true);
    }

}
