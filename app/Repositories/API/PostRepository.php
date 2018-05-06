<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\PostRepository as PostRepositoryInterface;

class PostRepository extends Repository implements PostRepositoryInterface {

    public function model() {
        return '\App\Post';
    }

}
