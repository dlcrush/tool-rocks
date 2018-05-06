<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\API\Contracts\WordPressRepository;

class WordPressController extends APIController
{

    protected $repo;

    public function __construct(WordPressRepository $repo) {
        $this->repo = $repo;
    }

    public function getPages()
    {
        $pages = $this->repo->getPages();

        return $this->respond($pages);
    }

}
