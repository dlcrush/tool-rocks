<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Band;

class BandTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'songs',
        'albums'
    ];

    public function transform(Band $band)
    {
        return [
            'id' => (int) $band->id,
            'name' => $band->name,
            'slug' => $band->slug,
            'image' => [
                'url' => $band->image_url
            ]
        ];
    }

    public function includeSongs(Band $band)
    {
        $songs = $band->songs;

        return $this->collection($songs, new SongTransformer);
    }

    public function includeAlbums(Band $band)
    {
        $albums = $band->albums;

        return $this->collection($albums, new AlbumTransformer);
    }

}
