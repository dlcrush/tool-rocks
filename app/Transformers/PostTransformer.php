<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Post;

class PostTransformer extends TransformerAbstract {

    public function transform(Post $post)
    {
        return [
            'id' => (int) $post->id,
            'WPID' => (int) $post->wp_id,
            'slug' => $post->slug,
            'title' => $post->title,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'publishedAt' => $post->published_at,
            'modifiedAt' => $post->modified_at,
            'status' => $post->status,
            'image' => $post->image,
            'type' => $post->format
        ];
    }

}
