<?php

namespace App\Transformers;

class SongTransformer extends Transformer {

    protected $bandTransformer;

    public function __construct(BandTransformer $bandTransformer) {
        $this->bandTransformer = $bandTransformer;
    }

    public function transform($item)
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'slug' => $item['slug'],
            'lyrics' => [
                'body' => $item['lyrics']
            ],
            'links' => [
                'web' => [
                    'href' => url("/songs/" . $item['slug'])
                ],
                'self' => [
                    'href' =>  url('/api/v1/songs/' . $item['id'])
                ]
            ],
            'band' => $this->bandTransformer->transform($item['band'])
        ];
    }

}
