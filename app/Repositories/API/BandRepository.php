<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\BandRepository as BandRepositoryInterface;

class BandRepository extends Repository implements BandRepositoryInterface {

    public function model() {
        return '\App\Band';
    }

}
