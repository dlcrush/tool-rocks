<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Video;

class VideoTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'channel',
        'songs'
    ];

    public function transform(Video $video)
    {
        $videoData = $video->youTubeData;

        return [
            'id' => (int) $video->id,
            'name' => $video->name,
            'slug' => $video->slug,
            'description' => $video->description,
            'views' => $videoData->views,
            'thumbsUp' => $videoData->thumbsUp,
            'thumbsDown' => $videoData->thumbsDown,
            'youtube_video_id' => $videoData->id,
            'images' => $videoData->images
        ];
    }

    public function includeChannel(Video $video) {
        $videoData = $video->youTubeData;
        $channel = $videoData->channel;

        return $this->item($channel, new ChannelTransformer);
    }

    public function includeSongs(Video $video) {
        $songs = $video->songs;

        return $this->collection($songs, new SetlistSongTransformer);
    }

}
