<?php

namespace App\Library\Http;

use App\Library\Http\Contracts\Http as HttpInterface;
use GuzzleHttp\Client;
use Illuminate\Cache\Repository as CacheRepository;

class Http implements HttpInterface {

    protected $client;
    protected $options;
    protected $cache;

    public function __construct(Client $client, $options = [], CacheRepository $cache) {
        $this->client = $client;
        $this->options = array_merge($this->getDefaultOptions(), $options);
        $this->cache = $cache;
    }

    public function setHeaders($headers = []) {
        $this->options['headers'] = $headers;
    }

    public function getHeaders() {
        return $this->options['headers'];
    }

    public function setOptions($options = []) {
        $this->options = array_merge($this->options, $options);
    }

    public function setTTL($ttl = 15) {
        $this->options['ttl'] = $ttl;
    }

    public function getTTL() {
        return $this->options['ttl'];
    }

    public function getOptions() {
        return $this->options;
    }

    public function get(String $url, $options = []) {
        $options = array_merge($this->options, $options);

        $cacheKey = $this->getCacheKey($url, $options);

        if (! $this->isNoCache($options) && $this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $response = $this->client->get($url, $options);

        if (! $this->isNoCache($options)) {
            $this->cache->put($cacheKey, $response->getBody()->getContents(), $options['ttl']);
        }

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

    private function getCacheKey(String $url, $options = []) {
        return $url . '.' . serialize($options);
    }

    private function isNoCache($options = []) {
        return ! isset($options['cache']) || $options['cache'] === false;
    }

    private function getDefaultOptions() {
        return [
            'ttl' => 15
        ];
    }

}
