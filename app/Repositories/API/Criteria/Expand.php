<?php

namespace App\Repositories\API\Criteria;

use App\Repositories\API\Contracts\Repository;

class Expand extends Criteria {

    protected $fields;

    public function __construct($fields=[]) {
        $this->fields = $fields;
    }

    public function apply($model, Repository $repository) {
        $query = $model->with($this->fields);
        return $query;
    }

}
