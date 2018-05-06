<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\API\Contracts\WordPressRepository;
use App\Repositories\API\Contracts\PostRepository;
use App\Post;
use Carbon\Carbon;

class ProcessWPPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WordPressRepository $wordPressRepo, PostRepository $postRepo)
    {
        $posts = $wordPressRepo->getPosts();

        foreach($posts as $post) {
            $p = $postRepo->findWhere('wp_id', $post->id)->first();
            if ($p == null) {
                $p = new Post();
            }

            $p->wp_id = $post->id;
            $p->title = $post->title->rendered;
            $p->content = $post->content->rendered;
            $p->excerpt = $post->excerpt->rendered;
            $p->status = $post->status;
            $p->published_at = Carbon::parse($post->date)->toDateTimeString();
            $p->modified_at = Carbon::parse($post->modified)->toDateTimeString();
            $p->slug = $post->slug;
            $p->type = $post->format;

            $p->save();
        }

        //$videoProcessor->process($this->video, true);
    }
}
