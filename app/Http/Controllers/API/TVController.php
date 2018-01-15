<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\TVQueueTransformer;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\TVRepository;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\OrderBy;
use App\Repositories\API\Criteria\NotNull;
use App\Repositories\API\Criteria\IsNull;
use App\TVQueue;

class TVController extends APIController
{
    protected $tvRepo;
    protected $tvQueueTransformer;

    public function __construct(TVRepository $tvRepo, TVQueueTransformer $tvQueueTransformer) {
        $this->tvRepo = $tvRepo;
        $this->tvQueueTransformer = $tvQueueTransformer;
    }

    public function getTV() {
        $this->tvRepo->pushCriteria(new Expand(['video.songs', 'video.images']));
        $this->tvRepo->pushCriteria(new IsNull('playback_end_time'));
        $this->tvRepo->pushCriteria(new OrderBy('created_at'));

        $queue = $this->tvRepo->all();

        $current = $queue->first();
        $tvQueue = new TVQueue();
        $tvQueue->current = $current;
        $tvQueue->upNext = $queue->except($current->id);

        $tv = fractal()
            ->item($tvQueue)
            ->transformWith($this->tvQueueTransformer)
            ->parseIncludes(['current.video.songs', 'upNext.video.songs'])
            ->toArray();

        return $this->respond($tv);
    }

}
