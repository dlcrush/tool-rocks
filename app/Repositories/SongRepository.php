<?php

namespace App\Repositories;

use App/Repositories/Contracts/SongRepository as SongRepositoryInterface;

class SongRepository extends Repository implements SongRepositoryInterface {

    public function model() {
        return '\App\Song';
    }

}
