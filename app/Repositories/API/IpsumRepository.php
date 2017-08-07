<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\IpsumRepository as IpsumRepositoryInterface;

class IpsumRepository extends Repository implements IpsumRepositoryInterface {

    public function model() {
        return '\App\Ipsum';
    }

}
