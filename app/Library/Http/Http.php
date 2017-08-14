<?php

namespace App\Library\Http;

use App\Library\Http\Contracts\Http as HttpInterface;
use GuzzleHttp\Client;

class Http implements HttpInterface {

    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function get($url) {

    }

    public function post($url) {

    }

    public function put($url) {

    }

    public function delete($url) {

    }

}
