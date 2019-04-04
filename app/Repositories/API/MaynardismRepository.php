<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\MaynardismRepository as MaynardismRepositoryInterface;

class MaynardismRepository extends Repository implements MaynardismRepositoryInterface {

    public function model() {
        return '\App\Maynardism';
    }

}
