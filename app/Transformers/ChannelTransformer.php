<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\YouTubeChannel;

class ChannelTransformer extends TransformerAbstract {

    public function transform(YouTubeChannel $channel)
    {
        return [
            'id' => (int) $channel->id,
            'name' => $channel->name,
            'slug' => $channel->slug,
            'description' => $channel->description,
            'views' => $channel->views,
            'subscribers' => $channel->subscribers,
            'uploads' => $channel->uploads,
            'images' => $channel->images
        ];
    }

}
