<?php

namespace App\Repositories\API\Criteria\Albums;

use App\Repositories\API\Criteria\Criteria;
use App\Repositories\API\Contracts\Repository;

class ExpandSongs extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->with('songs');
        return $query;
    }

}
