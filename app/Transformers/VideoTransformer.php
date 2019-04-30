<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Video;

class VideoTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'channel',
        'songs',
        'tags',
        'related'
    ];

    public function transform(Video $video)
    {
        return [
            'id' => (int) $video->id,
            'name' => $video->name,
            'slug' => $video->slug,
            'description' => $video->description,
            'duration' => $video->duration,
            'views' => $video->views,
            'thumbsUp' => $video->thumbs_up,
            'thumbsDown' => $video->thumbs_down,
            'youtube_video_id' => $video->video_id,
            'images' => $this->transformImages($video->images),
            'published_at' => $video->published_at,
            'channel' => [
                'id' => $video->channel_id,
                'name' => $video->channel_name
            ],
            'links' => [
                'web' => action('VideoController@getVideo', ['id' => $video->id, 'slug' => $video->slug])
            ],
            'meta' => [
                'title' => $video->meta_title,
                'description' => $video->meta_description,
                'keywords' => $video->meta_keywords
            ]
        ];
    }

    public function includeChannel(Video $video) {
        $channel = $video->channel;

        if ($channel) {
            return $this->item($channel, new ChannelTransformer);
        }
    }

    public function includeSongs(Video $video) {
        $songs = $video->songs;

        return $this->collection($songs, new SetlistSongTransformer);
    }

    public function includeTags(Video $video) {
        $tags = $video->tags;

        return $this->collection($tags, new TagTransformer);
    }

    public function includeRelated(Video $video) {
        $related = $video->related;

        return $this->collection($related, new VideoTransformer);
    }

    private function transformImages($images) {
        return $images->mapWithKeys(function ($item) {
            return [
                $item['size'] => [
                    'height' => $item['height'],
                    'width' => $item['width'],
                    'url' => $item['url']
                ]
            ];
        });
    }

}
