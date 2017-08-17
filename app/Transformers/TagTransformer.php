<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Tag;

class TagTransformer extends TransformerAbstract {

    public function transform(Tag $tag)
    {
        return [
            'id' => (int) $tag->id,
            'name' => $tag->name,
            'slug' => $tag->slug
        ];
    }

}
