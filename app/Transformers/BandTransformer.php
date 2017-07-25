<?php

namespace App\Transformers;

class BandTransformer extends Transformer {

    public function transform($item)
    {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'slug' => $item['slug'],
            'image' => [
                'url' => $item['image_url']
            ]
        ];
    }

}
