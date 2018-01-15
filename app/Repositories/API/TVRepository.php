<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\TVRepository as TVRepositoryInterface;

class TVRepository extends Repository implements TVRepositoryInterface {

    public function model() {
        return '\App\TV';
    }

}
