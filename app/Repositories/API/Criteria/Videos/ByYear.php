<?php

namespace App\Repositories\API\Criteria\Videos;

use App\Repositories\API\Contracts\Repository;
use App\Repositories\API\Criteria\Criteria;

class ByYear extends Criteria {

    protected $year;

    public function __construct($year) {
        $this->year = $year;
    }

    public function apply($model, Repository $repository) {
        $query = \DB::table('videos')
                    ->select('videos.id')
                    ->join('videos_tags', 'videos_tags.video_id', 'videos.id')
                    ->join('tags', 'tags.id', 'videos_tags.tag_id')
                    ->where('tags.slug', '=', '2017');

        $query2 = \DB::table('videos')
                    ->select('videos.id')
                    ->join('videos_tags', 'videos_tags.video_id', 'videos.id')
                    ->join('tags', 'tags.id', 'videos_tags.tag_id')
                    ->where('tags.slug', '=', 'california');

        $unions = ($query->unionAll($query2));

        $crazyAssQuery = \DB::table(\DB::raw("(" . $unions->toSql() . ') as t1'))->distinct()->groupBy('t1.id')->havingRaw('Count(*) >= 2')->mergeBindings($unions);
        $ids = $crazyAssQuery->get()->pluck('id');

        $videosThatMatchMyCrazyAssCriteriaQuery = $model->whereIn('id', $ids);

        //dump($videosThatMatchMyCrazyAssCriteriaQuery->get());

        return $videosThatMatchMyCrazyAssCriteriaQuery;
    }

}
