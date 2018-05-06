<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\PageRepository as PageRepositoryInterface;

class PageRepository extends Repository implements PageRepositoryInterface {

    public function model() {
        return '\App\Page';
    }

}
