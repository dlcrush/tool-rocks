<?php

namespace App\Transformers;

class AlbumTransformer extends Transformer {

    protected $songTransformer;

    public function __construct() {
        //$this->songTransformer = $songTransformer;
    }

    public function transform($item)
    {

        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'slug' => $item['slug'],
            'image' => [
                'url' => $item['image_url']
            ],
            "songs" => array_key_exists('songs', $item) ? $item['songs'] : null
        ];
    }

}
