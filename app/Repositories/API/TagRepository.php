<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\TagRepository as TagRepositoryInterface;

class TagRepository extends Repository implements TagRepositoryInterface {

    public function model() {
        return '\App\Tag';
    }

}
