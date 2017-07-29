<?php

namespace App\Repositories\API\Criteria\Albums;

use App\Repositories\API\Criteria\Criteria;
use App\Repositories\API\Contracts\Repository;

class ExpandBand extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->with('band');
        return $query;
    }

}
