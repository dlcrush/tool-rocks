<?php

namespace App\Library\Http;

use App\Library\Http\Contracts\Http as HttpInterface;
use GuzzleHttp\Client;

class Http implements HttpInterface {

    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function get(String $url) {
        $response = $this->client->get($url);
        return $response->getBody()->getContents();
    }

    public function getAsync(String $url) {
        return $this->client->getAsync($url);
    }

    public function post(String $url, $data=[]) {
        $response = $this->client->post();
    }

    public function put(String $url, $data=[]) {

    }

    public function delete(String $url, $data=[]) {

    }

}
