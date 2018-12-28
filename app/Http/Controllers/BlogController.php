<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepository;

class BlogController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo) {
        $this->postRepo = $postRepo;
    }

    public function getPosts($id, $slug='') {
        $params = [];

        if (\Request::has('page')) {
            $params['page'] = \Request::get('page');
        }

        $posts = $this->postRepo->getPosts($params);

        return view('blog.index', compact('posts'));
    }

    public function getPost($id, $slug='') {
        $post = $this->postRepo->getPost($id);

        return view('blog.show', compact('post'));
    }
}
