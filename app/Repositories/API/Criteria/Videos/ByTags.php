<?php

namespace App\Repositories\API\Criteria\Videos;

use App\Repositories\API\Contracts\Repository;
use App\Repositories\API\Criteria\Criteria;

class ByTags extends Criteria {

    protected $tags;

    public function __construct($tags) {
        $this->tags = $tags;
    }

    public function apply($model, Repository $repository) {
        $query = $model->join('videos_tags', 'videos_tags.video_id', 'videos.id')->join('tags', 'tags.id', 'videos_tags.tag_id')->whereIn('tags.slug', $this->tags)->select('videos.*');
        return $query;
    }

}
