<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\TagTransformer;
use App\Repositories\API\Contracts\TagRepository;
use App\Repositories\API\Criteria\Filter;

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
        if (\Request::has('filter')) {
            $filter = \Request::get('filter');
            if ($filter === 'date') {
                $this->tagRepo->pushCriteria(new Filter('type', 'date'));
            }
        }

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

    public function ingestTags() {

        foreach($states as $state) {
            $tag = [
                'name' => $state,
                'slug' => str_replace(" ", "-", strtolower($state)),
                'type' => 'state'
            ];

            $this->tagRepo->create($tag);
        }
    }
}
