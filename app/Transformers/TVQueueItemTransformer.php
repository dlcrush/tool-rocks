<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\TV;

class TVQueueItemTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'video'
    ];

    public function transform(TV $queueItem)
    {
        return [
            'id' => $queueItem->id,
            'playback_start_time' => $queueItem->playback_start_time,
            'playback_end_time' => $queueItem->playback_end_time,
            'added_to_queue' => $queueItem->created_at
        ];
    }

    public function includeVideo(TV $queueItem)
    {
        $video = $queueItem->video;

        return $this->item($video, new VideoTransformer);
    }

}
