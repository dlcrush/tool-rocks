<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\PageRepository;

class BlogController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo, PageRepository $pageRepo) {
        $this->postRepo = $postRepo;
        $this->pageRepo = $pageRepo;
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

    public function getPage($slug) {
        $page = $this->pageRepo->getPage($slug);

        return view('pages.show', compact('page'));
    }

    public function getAbout() {
        return $this->getPage('about');
    }

    public function getLinks() {
        return $this->getPage('links');
    }
}
