<?php

namespace App\Repositories\Contracts;

interface PageRepository {
    public function getPages($options);

    public function getPage($id);
}
