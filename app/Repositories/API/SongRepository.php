<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\SongRepository as SongRepositoryInterface;

class SongRepository extends Repository implements SongRepositoryInterface {

    public function model() {
        return '\App\Song';
    }

}
