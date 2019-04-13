<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\PageTransformer;
use App\Repositories\API\Contracts\PageRepository;
use App\Repositories\API\Criteria\Expand;

class PageController extends APIController
{

    protected $page;
    protected $pageTransformer;

    public function __construct(PageRepository $page, PageTransformer $pageTransformer)
    {
        $this->page = $page;
        $this->pageTransformer = $pageTransformer;
    }

    public function getPages()
    {
        $pages = fractal()
           ->collection($this->page->all())
           ->transformWith($this->pageTransformer)
           ->toArray();

        return $this->respond($pages);
    }

    public function getPage($id) {
        $page = fractal()
            ->item($this->page->findByIdOrSlug($id))
            ->transformWith($this->pageTransformer)
            ->toArray();

        return $this->respond($page);
    }

}
