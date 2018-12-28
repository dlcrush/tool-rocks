<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Page;

class PageTransformer extends TransformerAbstract {

    public function transform(Page $page)
    {
        return [
            'id' => (int) $page->id,
            'WPID' => (int) $page->wp_id,
            'slug' => $page->slug,
            'title' => $page->title,
            'excerpt' => $page->excerpt,
            'content' => $page->content,
            'publishedAt' => $page->published_at,
            'modifiedAt' => $page->modified_at,
            'status' => $page->status,
            'image' => $page->image
        ];
    }

}
