<?php

namespace App\Library\Http\Contracts;

interface Http {

    public function get(String $url);

    public function getAsync(String $url);

    public function post(String $url, $data=[]);

    public function put(String $url, $data=[]);

    public function delete(String $url, $data=[]);

}
