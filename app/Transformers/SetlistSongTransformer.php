<?php

namespace App\Transformers;

use App\Song;

class SetlistSongTransformer extends SongTransformer {

    public function transform(Song $song)
    {
        return array_merge(parent::transform($song), [
            'order' => $song->pivot->order,
            'start_time' => $song->pivot->start_time,
            'end_time' => $song->pivot->end_time
        ]);
    }

}
