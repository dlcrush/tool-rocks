<?php

namespace App\Repositories\API\Contracts;

use App\Repositories\API\Criteria\Criteria as C;

interface Criteria {

    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(C $criteria);

    public function pushCriteria(C $criteria);

    public function applyCriteria();

}
