<?php

namespace App\Transformers;

class BandTransformer extends Transformer {

    protected $albumTransformer;

    public function __construct(AlbumTransformer $albumTransformer) {
        $this->albumTransformer = $albumTransformer;
    }

    public function transform($item)
    {

        $transformedItem = [
            'id' => $item['id'],
            'name' => $item['name'],
            'slug' => $item['slug']
        ];

        $image = array_get($item, 'image_url');
        if ($image != null) {
            $transformedItem = array_add($transformedItem, 'image.url', $image);
        }

        $albums = array_get($item, 'albums');
        if ($albums != null) {
            $transformedAlbums = $this->albumTransformer->transformCollection($albums);
            $transformedItem = array_add($transformedItem, 'albums', $transformedAlbums);
        }

        return $transformedItem;
    }

}
