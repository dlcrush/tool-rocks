<?php

namespace App\Repositories\API\Criteria;

use App\Repositories\API\Contracts\Repository;

class Not extends Criteria {

    protected $field;
    protected $value;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function apply($model, Repository $repository) {
        $query = $model->where($this->field, '!=', $this->value);
        return $query;
    }

}
