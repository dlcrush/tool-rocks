<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\TVQueue;

class TVQueueTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'current',
        'upNext'
    ];

    public function transform(TVQueue $queue)
    {
        return [];
    }

    public function includeCurrent(TVQueue $queue)
    {
        $current = $queue->current;

        return $this->item($current, new TVQueueItemTransformer);
    }

    public function includeUpNext(TVQueue $queue)
    {
        $upNext = $queue->upNext;

        return $this->collection($upNext, new TVQueueItemTransformer);
    }

}
