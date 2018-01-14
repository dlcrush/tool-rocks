<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Tour;

class TourTransformer extends TransformerAbstract {

    protected $availableIncludes = [
        'shows'
    ];

    public function transform(Tour $tour)
    {
        return [
            'id' => (int) $tour->id,
            'name' => $tour->name,
            'slug' => $tour->slug,
            'date' => $tour->date
        ];
    }

    public function includeShows(Tour $tour)
    {
        $shows = $tour->shows;

        return $this->collection($shows, new ShowTransformer);
    }

}
