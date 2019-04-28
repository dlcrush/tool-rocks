<?php

namespace App\Repositories\API\Criteria\Videos;

use App\Repositories\API\Contracts\Repository;
use App\Repositories\API\Criteria\Criteria;
use Illuminate\Support\Collection;

class Search extends Criteria {

    protected $criteria;

    public function __construct($criteria) {
        $this->criteria = [];

        if (is_array($criteria)) {
            $this->criteria = $criteria;
        }
    }

    public function apply($model, Repository $repository) {

        $query = $model;

        $criteria = $this->criteria;
        $queries = [];

        $baseTagsQuery = \DB::table('videos')
                        ->select('videos.id')
                        ->join('videos_tags', 'videos_tags.video_id', 'videos.id')
                        ->join('tags', 'tags.id', 'videos_tags.tag_id');

        if (array_has($criteria, 'year')) {
            $year = array_get($criteria, 'year');
            $yearQuery = (clone $baseTagsQuery)->where('tags.slug', '=', $year);
            array_push($queries, $yearQuery);
        }

        if (array_has($criteria, 'type')) {
            $type = array_get($criteria, 'type');
            $typeQuery = (clone $baseTagsQuery)->where('tags.slug', '=', $type);
            array_push($queries, $typeQuery);
        }

        if (array_has($criteria, 'text')) {
            $text = array_get($criteria, 'text');
            $query = $query->where('name', 'like', '%' . $text . '%');
        }

        $songsUnions = null;
        $songsQueries = [];

        if (array_has($criteria, 'songs')) {
            $songs = array_get($criteria, 'songs');
            $songs = explode(',', $songs);
            if (sizeof($songs) > 0) {
                $songsQuery = \DB::table('videos')->select('videos.id')->join('videos_songs', 'videos_songs.video_id', 'videos.id')->join('songs', 'songs.id', 'videos_songs.song_id');

                foreach($songs as $song) {
                    $songQuery = (clone $songsQuery)->where('songs.slug', '=', $song);
                    array_push($songsQueries, $songQuery);
                }

                foreach($songsQueries as $songQuery) {
                    if (is_null($songsUnions)) {
                        $songsUnions = $songQuery;
                    } else {
                        $songsUnions = $songsUnions->unionAll($songQuery);
                    }
                }

            }
        }

        $tagsUnions = null;
        $tagsQueries = [];

        if (array_has($criteria, 'tags')) {
            $tags = array_get($criteria, 'tags');
            $tags = explode(',', $tags);
            if (sizeof($tags) > 0) {
                $tagsQuery = (clone $baseTagsQuery);

                foreach($tags as $tag) {
                    $tagQuery = (clone $tagsQuery)->where('tags.slug', '=', $tag);
                    array_push($tagsQueries, $tagQuery);
                }

                foreach($tagsQueries as $tagQuery) {
                    if (is_null($tagsUnions)) {
                        $tagsUnions = $tagQuery;
                    } else {
                        $tagsUnions = $tagsUnions->unionAll($tagQuery);
                    }
                }

            }
        }

        $unions = null;
        foreach($queries as $bacon) {
            if (is_null($unions)) {
                $unions = $bacon;
            } else {
                $unions = $unions->unionAll($bacon);
            }
        }

        $ids = new Collection();

        if ($unions) {
            $crazyAssQuery = \DB::table(\DB::raw("(" . $unions->toSql() . ') as t1'))->distinct()->select('id')->groupBy('t1.id')->havingRaw('Count(*) >= ' . sizeof($queries))->mergeBindings($unions);

            $ids = $crazyAssQuery->get()->pluck('id');
        }

        if ($songsUnions) {
            $crazyAssQuery = \DB::table(\DB::raw("(" . $songsUnions->toSql() . ') as t1'))->distinct()->select('id')->groupBy('t1.id')->havingRaw('Count(*) >= ' . sizeof($songsQueries))->mergeBindings($songsUnions);

            if (! $ids->isEmpty()) {
                $ids = $ids->intersect($crazyAssQuery->get()->pluck('id'));
            } else {
                $ids = $crazyAssQuery->get()->pluck('id');
            }
        }

        if ($tagsUnions) {
            $crazyAssQuery = \DB::table(\DB::raw("(" . $tagsUnions->toSql() . ') as t1'))->distinct()->select('id')->groupBy('t1.id')->havingRaw('Count(*) >= ' . sizeof($tagsQueries))->mergeBindings($tagsUnions);

            if (! $ids->isEmpty()) {
                $ids = $ids->intersect($crazyAssQuery->get()->pluck('id'));
            } else {
                $ids = $crazyAssQuery->get()->pluck('id');
            }
        }

        if ($unions || $songsUnions || $tagsUnions) {
            $query = $query->whereIn('id', $ids);
        }

        return $query;
    }

}
