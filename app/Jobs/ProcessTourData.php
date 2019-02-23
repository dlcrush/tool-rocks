<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\API\Contracts\SetlistRepository;
use App\Page;
use Carbon\Carbon;

class ProcessTourData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $bandId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bandId = config('setlist.tool_band_id');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SetlistRepository $setlistRepo)
    {
        echo 'Handle';

        $shows = $setlistRepo->getAllShows($this->bandId);

        dd($shows);
    }
}
