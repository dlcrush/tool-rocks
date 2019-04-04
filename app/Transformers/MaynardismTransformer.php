<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Maynardism;

class MaynardismTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'video'
    ];

    public function transform(Maynardism $maynardism)
    {
        return [
            'id' => (int) $maynardism->id,
            'content' => $maynardism->content
        ];
    }

    public function includeVideo(Maynardism $maynardism)
    {
        $video = $maynardism->video;

        return $this->item($video, new VideoTransformer);
    }

}
