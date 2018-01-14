<?php

namespace App\Repositories\API\Criteria;

use App\Repositories\API\Contracts\Repository;

class NotNull extends Criteria {

    protected $fields;

    public function __construct($fields) {
        if (! is_array($fields)) {
            $fields = [$fields];
        }

        $this->fields = $fields;
    }

    public function apply($model, Repository $repository) {
        $query = $model;

        foreach($this->fields as $field) {
            $query = $query->whereNotNull($field);
        }

        return $query;
    }

}
