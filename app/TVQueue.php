<?php

namespace App;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class TVQueue implements JsonSerializable, Jsonable, Arrayable {
    use MagicSetterAndGetter;

    protected $current;
    protected $upNext;
    protected $recentlyPlayed;

    public function __construct() {
        // do some initialization shit here
    }

    public function jsonSerialize() {
        return $this->toArray();
    }

    public function toJson($options = 0) {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function toArray() {
        return [
            'current' => $this->current,
            'upNext' => $this->upNext,
            'recentlyPlayed' => $this->recentlyPlayed
        ];
    }
}
