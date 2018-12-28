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
        $query = $model;

        if (! collect($query->getQuery()->joins)->pluck('table')->contains('videos_tags')) {
            $query = $model->join('videos_tags', 'videos_tags.video_id', 'videos.id')
                    ->join('tags', 'tags.id', 'videos_tags.tag_id');
        }

        $mode = 'OR';
        $delimeter = '|';
        $tags = $this->tags;

        // If it's not an array, we'll make it into an array.
        if (! is_array($tags)) {
            if (! is_string($tags)) {
                $tags = '';
            }

            if (strpos($tags, '+') > -1) {
                $mode = 'AND';
                $delimeter = '+';
            } elseif (strpos($tags, ',') > -1) {
                $delimeter = ',';
            }

            $tags = explode($delimeter, $tags);
        }

        if ($mode == 'OR') {
            $query = $query->whereIn('tags.slug', $tags);
        } else if ($mode == 'AND') {
            foreach($tags as $tag) {
                $query = $query->where('tags.slug', '=', $tag);
            }
        }

        $query = $query->select('videos.*');

        $query = $query->groupBy('videos.id');

        return $query;
    }

}
