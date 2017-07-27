<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Album;

class AlbumTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'songs',
        'band'
    ];

    public function transform(Album $album)
    {
        return [
            'id' => (int) $album->id,
            'name' => $album->name,
            'slug' => $album->slug,
            'image' => [
                'url' => $album->image_url
            ],
            "released" => $album->release_date
        ];
    }

    public function includeSongs(Album $album)
    {
        $songs = $album->songs;

        return $this->collection($songs, new SongTransformer());
    }

    public function includeBand(Album $album)
    {
        $band = $album->band;

        return $this->item($band, new BandTransformer());
    }

}
