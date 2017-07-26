<?php

namespace App\Repositories\API\Criteria;

use App\Repositories\API\Contracts\Repository;

abstract class Criteria {

    public abstract function apply($model, Repository $repository);

}
