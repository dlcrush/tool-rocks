<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Song;

class SongTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'band',
        'albums'
    ];

    public function transform(Song $song)
    {
        return [
            'id' => (int) $song->id,
            'name' => $song->name,
            'slug' => $song->slug,
            'has_lyrics' => $song->has_lyrics,
            'lyrics' => [
                'body' => $song->lyrics
            ],
            'links' => [
                'web' => [
                    'href' => url("/songs/" . $song->slug)
                ],
                'self' => [
                    'href' =>  url('/api/v1/songs/' . $song->id)
                ]
            ]
        ];
    }

    public function includeBand(Song $song)
    {
        $band = $song->band;

        return $this->item($band, new BandTransformer);
    }

    public function includeAlbums(Song $song)
    {
        $albums = $song->albums;

        return $this->collection($albums, new AlbumTransformer());
    }

}
