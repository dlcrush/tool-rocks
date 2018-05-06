<?php

namespace App\Repositories\API\Contracts;

interface WordPressRepository {

    public function getPosts($data);

    public function getPages($data);

    //public function getPost($data);

}
