<?php

namespace App\Library\Http;

use App\Library\Http\Contracts\ParamsBuilder as ParamsBuilderInterface;

class ParamsBuilder implements ParamsBuilderInterface {

    protected $params;

    public function __construct() {
        $this->params = [];
    }

    // Alias for set (because I prefer add)
    public function add(String $key, String $value) {
        return $this->set($key, $value);
    }

    public function set(String $key, String $value) {
        $this->params[$key] = $value;
        return $this;
    }

    public function remove(String $key) {
        unset($this->params[$key]);
        return $this;
    }

    public function has(String $key) {
        return array_key_exists($key, $params);
    }

    public function get(String $key) {
        return $this->params[$key];
    }

    public function build($params=[], $startWithAmpersand=false) {
        $paramsString = '';
        $params = array_merge($params, $this->params);
        $divider = $startWithAmpersand ? '&' : '?';
        $first = true;

        foreach($params as $k => $v) {
            $paramsString .= $divider . $k . '=' . $v;
            if ($first) {
                $divider = '&';
                $first = false;
            }
        }

        return $paramsString;
    }

}
