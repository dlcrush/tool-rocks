<?php

namespace App\Library\Http\Contracts;

interface ParamsBuilder {

    public function add(String $key, String $value);

    public function set(String $key, String $value);

    public function remove(String $key);

    public function has(String $key);

    public function get(String $key);

    public function build($params=[], $startWithAmpersand=false);

}
