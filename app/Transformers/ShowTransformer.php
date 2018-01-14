<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Show;

class ShowTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'songs',
        'video'
    ];

    public function transform(Show $show)
    {
        return [
            'id' => (int) $show->id,
            'name' => $show->name,
            'slug' => $show->slug,
            'date' => $show->date
        ];
    }

    public function includeSongs(Show $show)
    {
        $songs = $show->songs;

        return $this->collection($songs, new SetlistSongTransformer);
    }

    public function includeVideo(Show $show)
    {
        $video = $show->video;

        if ($video != null) {
            return $this->item($video, new VideoTransformer);
        }
    }

    // public function includeVenue(Show $show)
    // {
    //     $venue = $show->venue;

    //     return $this->collection($venue, new VenueTransformer);
    // }

}
