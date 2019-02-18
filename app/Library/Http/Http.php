<?php

namespace App\Library\Http;

use App\Library\Http\Contracts\Http as HttpInterface;
use GuzzleHttp\Client;

class Http implements HttpInterface {

    protected $client;
    protected $options;

    public function __construct(Client $client, $options = []) {
        $this->client = $client;
        $this->options = $options;
    }

    public function setHeaders($headers = []) {
        $this->options['headers'] = $headers;
    }

    public function getHeaders() {
        return $this->options['headers'];
    }

    public function setOptions($options = []) {
        $this->options = $options;
    }

    public function getOptions() {
        return $this->options;
    }

    public function get(String $url, $options = []) {
        if ($options === []) {
            $options = $this->options;
        }

        $response = $this->client->get($url, $options);
        return $response->getBody()->getContents();
    }

    public function getAsync(String $url, $options = []) {
        if ($options === []) {
            $options = $this->options;
        }

        return $this->client->getAsync($url, $options);
    }

    public function post(String $url, $data=[], $options = []) {
        if ($options === []) {
            $options = $this->options;
        }

        $response = $this->client->post();
    }

    public function put(String $url, $data=[], $headers = []) {

    }

    public function delete(String $url, $data=[], $headers = []) {

    }

}
