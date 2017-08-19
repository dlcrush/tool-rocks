<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\TagTransformer;
use App\Repositories\API\Contracts\TagRepository;

class TagController extends APIController
{

    protected $tagRepo;
    protected $tagTransformer;

    public function __construct(TagRepository $tagRepo, TagTransformer $tagTransformer) {
        $this->tagRepo = $tagRepo;
        $this->tagTransformer = $tagTransformer;
    }

    public function getTags()
    {
        $tags = fractal()
           ->collection($this->tagRepo->all())
           ->transformWith($this->tagTransformer)
           ->toArray();

        return $this->respond($tags);
    }

    public function getTag($id) {
        $tag = fractal()
           ->item($this->tagRepo->find($id))
           ->transformWith($this->tagTransformer)
           ->toArray();

        return $this->respond($tag);
    }
}
