<?php

namespace App;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class YouTubeVideo implements JsonSerializable, Jsonable, Arrayable {
    use MagicSetterAndGetter;

    protected $id;
    protected $title;
    protected $description;
    protected $channel;
    protected $views;
    protected $thumbsUp;
    protected $thumbsDown;
    protected $images;
    protected $channelId;

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
            'title' => $this->title,
            'description' => $this->description,
            'channelId' => $this->channelId,
            'views' => $this->views,
            'thumbsUp' => $this->thumbsUp,
            'thumbsDown' => $this->thumbsDown,
            'views' => $this->views,
            'channel' => $this->channel->toArray(),
            'images' => $this->images
        ];
    }
}