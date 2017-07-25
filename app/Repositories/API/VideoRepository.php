<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\VideoRepository as VideoRepositoryInterface;

class VideoRepository extends Repository implements VideoRepositoryInterface {

    public function model() {
        return '\App\Video';
    }

}
