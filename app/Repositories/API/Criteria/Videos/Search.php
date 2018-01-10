<?php

namespace App\Repositories\API\Criteria\Videos;

use App\Repositories\API\Contracts\Repository;
use App\Repositories\API\Criteria\Criteria;

class Search extends Criteria {

    protected $criteria;

    public function __construct($criteria) {
        $this->criteria = [];

        if (is_array($criteria)) {
            $this->criteria = $criteria;
        }
    }

    public function apply($model, Repository $repository) {

        $criteria = $this->criteria;
        $queries = [];

        $baseQuery = \DB::table('videos')
                        ->select('videos.id')
                        ->join('videos_tags', 'videos_tags.video_id', 'videos.id')
                        ->join('tags', 'tags.id', 'videos_tags.tag_id');

        if (array_has($criteria, 'tags')) {
            $tags = array_get($criteria, 'tags');
            $tagQuery = (clone $baseQuery)->where('tags.slug', '=', $tags);
            array_push($queries, $tagQuery);
        }

        if (array_has($criteria, 'year')) {
            $year = array_get($criteria, 'year');
            $yearQuery = (clone $baseQuery)->where('tags.slug', '=', $year);
            array_push($queries, $yearQuery);
        }

        if (array_has($criteria, 'type')) {
            $type = array_get($criteria, 'type');
            $typeQuery = (clone $baseQuery)->where('tags.slug', '=', $type);
            array_push($queries, $typeQuery);
        }

        $unions = null;
        foreach($queries as $bacon) {
            if (is_null($unions)) {
                $unions = $bacon;
            } else {
                $unions = $unions->unionAll($bacon);
            }
        }

        $crazyAssQuery = \DB::table(\DB::raw("(" . $unions->toSql() . ') as t1'))->distinct()->groupBy('t1.id')->havingRaw('Count(*) >= ' . sizeof($queries))->mergeBindings($unions);
        $ids = $crazyAssQuery->get()->pluck('id');

        $videosThatMatchMyCrazyAssCriteriaQuery = $model->whereIn('id', $ids);

        return $videosThatMatchMyCrazyAssCriteriaQuery;
    }

}
