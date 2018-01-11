<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessYTVideo;
use App\Video;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Criteria\Expand;

class IngestYTData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingest:yt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest data from YouTube';

    protected $videoRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(VideoRepository $videoRepo)
    {
        parent::__construct();
        $this->videoRepo = $videoRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $videos = $this->videoRepo->all();
        foreach($videos as $video) {
            ProcessYTVideo::dispatch($video);
        }
    }
}
