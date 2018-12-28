<?php

namespace App\Repositories\Contracts;

interface PostRepository {
    public function getPosts($options);

    public function getPost($id);
}
