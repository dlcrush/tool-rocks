<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\PostTransformer;
use App\Repositories\API\Contracts\PostRepository;
use App\Repositories\API\Criteria\Expand;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class PostController extends APIController
{

    protected $post;
    protected $postTransformer;

    public function __construct(PostRepository $post, PostTransformer $postTransformer)
    {
        $this->post = $post;
        $this->postTransformer = $postTransformer;
    }

    public function getPosts()
    {
        $paginator = $this->post->paginate(5);

        $posts = fractal()
           ->collection($paginator->getCollection())
           ->transformWith($this->postTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($paginator))
           ->toArray();

        return $this->respond($posts);
    }

    public function getPost($id) {
        $post = fractal()
            ->item($this->post->find($id))
            ->transformWith($this->postTransformer)
            ->toArray();

        return $this->respond($post);
    }

}
