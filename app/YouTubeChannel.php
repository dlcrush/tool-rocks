<?php

namespace App;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class YouTubeChannel implements JsonSerializable, Jsonable, Arrayable {
    use MagicSetterAndGetter;

    protected $id;
    protected $name;
    protected $description;
    protected $slug;
    protected $images;
    protected $views;
    protected $subscribers;
    protected $uploads;

    // protected $thumbsUp;
    // protected $thumbsDown;
    // protected $channelId;

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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'images' => $this->images,
            'views' => $this->views,
            'subscribers' => $this->subscribers,
            'uploads' => $this->uploads
        ];
    }
}
