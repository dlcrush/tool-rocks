<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\SetlistRepository as SetlistRepositoryInterface;
use App\Library\Http\UrlBuilder;
use App\Library\Http\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SetlistRepository implements SetlistRepositoryInterface {

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder, String $apiKey) {
        $this->http = $http;
        $this->http->setOptions([
            'headers' => [
                'Accept' => 'application/json',
                'x-api-key' => $apiKey
            ]
        ]);
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl('https://api.setlist.fm/rest/1.0/');
    }

    public function getBand($bandId) {
        $url = $this->urlBuilder
            ->path('artist/' . $bandId)
            ->params([])
            ->build();

        $response = json_decode($this->http->get($url));

        return $response;
    }

    public function getShows($bandId, $page=1) {
        $url = $this->urlBuilder
            ->path('artist/' . $bandId . '/setlists')
            ->params([ 'p' => $page ])
            ->build();

        $response = json_decode($this->http->get($url));

        return $response;
    }

    public function getAllShows($bandId) {

        $cacheKey = 'SetlistRepo.getAllShows.' . $bandId;

        if (Cache::has($cacheKey)) {
            return json_decode(Cache::get($cacheKey));
        }

        $shows = [];

        $firstPage = $this->getShows($bandId);

        $totalItems = $firstPage->total;
        $itemsPerPage = $firstPage->itemsPerPage;
        $numOfPages = intval(ceil($totalItems / $itemsPerPage));

        $shows = array_merge($shows, $firstPage->setlist);

        for($i = 2; $i <= $numOfPages; $i ++) {
            $page = $this->getShows($bandId, $i);

            $shows = array_merge($shows, $page->setlist);
        }

        $minutes = 60;
        Cache::put($cacheKey, json_encode($shows), $minutes);

        return $shows;

        //dd($numOfPages);
    }

    public function getShowsByYear($bandId, $year) {
        $allShows = $this->getAllShows($bandId);

        $yearShows = [];

        foreach($allShows as $show) {
            if (strpos($show->eventDate, '-'.$year) > -1) {
                array_push($yearShows, $show);
            }
        }

        return $yearShows;
    }
}
