<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\AlbumRepository as AlbumRepositoryInterface;

class AlbumRepository extends Repository implements AlbumRepositoryInterface {

    public function model() {
        return '\App\Album';
    }

}
