<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessTourData;
use App\Repositories\API\Contracts\SetlistRepository;

class IngestTourData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingest:tours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest tour data from Setlist.fm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SetlistRepository $setlistRepo)
    {
        $bandId = config('setlist.tool_band_id');
        $year = '2010';
        $shows = $setlistRepo->getShowsByYear($bandId, $year);

        foreach($shows as $show) {
            ProcessSetlistShow::dispatch($show);
        }

        //ProcessTourData::dispatch();
    }
}
