<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\API\Contracts\WordPressRepository;
use App\Repositories\API\Contracts\PageRepository;
use App\Page;
use Carbon\Carbon;

class ProcessWPPages implements ShouldQueue
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
    public function handle(WordPressRepository $wordPressRepo, PageRepository $pageRepo)
    {
        $pages = $wordPressRepo->getPages();

        foreach($pages as $page) {
            $p = $pageRepo->findWhere('wp_id', $page->id)->first();
            if ($p == null) {
                $p = new Page();
            }

            $p->wp_id = $page->id;
            $p->title = $page->title->rendered;
            $p->content = $page->content->rendered;
            $p->excerpt = $page->excerpt->rendered;
            $p->status = $page->status;
            $p->published_at = Carbon::parse($page->date)->toDateTimeString();
            $p->modified_at = Carbon::parse($page->modified)->toDateTimeString();
            $p->slug = $page->slug;

            $p->save();
        }

        //$videoProcessor->process($this->video, true);
    }
}
