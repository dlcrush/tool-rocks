<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Contracts\TVRepository;
use App\Repositories\API\Criteria\Expand;
use App\Repositories\API\Criteria\IsNull;
use App\Repositories\API\Criteria\OrderBy;
use App\Repositories\API\Criteria\Randomize;
use Carbon\Carbon;

class FillTVQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tv:fillQueue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the TV queue with random videos';

    protected $tvRepo;

    protected $videoRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TVRepository $tvRepo, VideoRepository $videoRepo)
    {
        parent::__construct();
        $this->videoRepo = $videoRepo;
        $this->tvRepo = $tvRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->tvRepo->pushCriteria(new Expand('video'));
        $this->tvRepo->pushCriteria(new IsNull('playback_end_time'));
        $this->tvRepo->pushCriteria(new OrderBy('created_at'));
        $videosNotYetPlayed = $this->tvRepo->all();

        if (sizeof($videosNotYetPlayed) > 6) {
            return; // no need to add more
        }

        //$this->videoRepo->pushCriteria(new OrderBy('views'));
        $this->videoRepo->pushCriteria(new Randomize());
        $availableVideosToAdd = $this->videoRepo->findNotIn('id', $videosNotYetPlayed->pluck('video_id'));
        //dd($availableVideosToAdd->pluck('id'));
        $videosToAdd = $availableVideosToAdd->take(10);
        //dd($videosToAdd->pluck('id'));

        $this->tvRepo->clearCriteria();

        $first = true;
        foreach($videosToAdd as $v) {
            $this->tvRepo->create([
                'video_id' => $v->id,
                'playback_start_time' => $first ? Carbon::parse('01/15/2018') : null,
                'playback_end_time' => null
            ]);
            $first = false;
        }
    }
}
