<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\API\Contracts\VideoRepository;
use App\Repositories\API\Criteria\Take;
use App\Repositories\API\Criteria\Randomize;
use App\Repositories\API\Criteria\Videos\Search;
use App\Repositories\API\Criteria\NotNull;
use App\Repositories\API\Criteria\Not;
use App\Repositories\API\Criteria\Expand;
use Illuminate\Database\DatabaseManager;
use Carbon\Carbon;

class GenerateDailyFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyfix:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the dailyfix table with random live videos.';

    protected $videoRepo;

    protected $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(VideoRepository $videoRepo, DatabaseManager $db)
    {
        parent::__construct();
        $this->videoRepo = $videoRepo;
        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->videoRepo->pushCriteria(new Search([
            'tags' => 'live'
        ]));
        $this->videoRepo->pushCriteria(new NotNull(['views']));
        $this->videoRepo->pushCriteria(new Not('unlisted', true));
        $this->videoRepo->pushCriteria(new Randomize());
        $this->videoRepo->pushCriteria(new Take(5));

        $videoIds = $this->videoRepo->all()->pluck('id');

        $dailyFixData = [];

        foreach($videoIds as $video_id) {
            array_push($dailyFixData, [
                'video_id' => $video_id,
                'date' => Carbon::now()
            ]);
        }

        $this->db->table('dailyfix')->truncate();

        $this->db->table('dailyfix')->insert($dailyFixData);
    }
}
