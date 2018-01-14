<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\ShowRepository as ShowRepositoryInterface;

class ShowRepository extends Repository implements ShowRepositoryInterface {

    public function model() {
        return '\App\Show';
    }

}
