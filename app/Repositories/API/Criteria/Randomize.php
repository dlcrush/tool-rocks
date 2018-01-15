<?php

namespace App\Repositories\API\Criteria;

use App\Repositories\API\Contracts\Repository;

class Randomize extends Criteria {

    public function apply($model, Repository $repository) {
        $query = $model->inRandomOrder();
        return $query;
    }

}
