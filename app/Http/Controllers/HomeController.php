<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Http\Contracts\Http;
use App\Library\Http\Contracts\UrlBuilder;

class HomeController extends Controller
{

    protected $http;
    protected $urlBuilder;

    public function __construct(Http $http, UrlBuilder $urlBuilder) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl(url('/') . '/api/v1/');
        $apiKey = \Config::get('api.api_key');
        $this->urlBuilder->addParam('key', $apiKey);
    }

    public function getHome() {
        $url = $this->urlBuilder
            ->path('home')
            ->params([])
            ->build();

        $data = json_decode($this->http->get($url), true);

        return view('home', compact('data'));
    }

}
