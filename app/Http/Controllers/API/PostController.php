<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Transformers\PostTransformer;
use App\Repositories\API\Contracts\PostRepository;
use App\Repositories\API\Criteria\Expand;

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
        $posts = fractal()
           ->collection($this->post->all())
           ->transformWith($this->postTransformer)
           ->toArray();

        return $this->respond($posts);
    }

}
