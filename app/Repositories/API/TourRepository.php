<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\TourRepository as TourRepositoryInterface;

class TourRepository extends Repository implements TourRepositoryInterface {

    public function model() {
        return '\App\Tour';
    }

}
