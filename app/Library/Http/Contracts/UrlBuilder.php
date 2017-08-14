<?php

namespace App\Library\Http\Contracts;

interface UrlBuilder {

    public function setBaseUrl(String $baseUrl);

    public function addParam(String $key, String $value);

    public function removeParam(String $key);

    public function hasParam(String $key);

    public function setParam(String $key, String $value);

    public function setParams(array $params);

    public function setResource(String $resource);

    public function resource(String $resource);

    public function params(array $params);

    public function build();

}
