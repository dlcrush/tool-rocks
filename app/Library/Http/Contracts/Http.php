<?php

namespace App\Library\Http\Contracts;

interface Http {

    public function setHeaders($headers = []);

    public function getHeaders();

    public function setOptions($options = []);

    public function getOptions();

    public function get(String $url, $options = []);

    public function getAsync(String $url, $options = []);

    public function post(String $url, $data=[], $options = []);

    public function put(String $url, $data=[], $options = []);

    public function delete(String $url, $data=[], $options = []);

    public function setTTL($ttl = 15);

    public function getTTL();

}
