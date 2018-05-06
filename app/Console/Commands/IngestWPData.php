<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ProcessWPPages;
use App\Jobs\ProcessWPPosts;

class IngestWPData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingest:wp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest data from WordPress';

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
    public function handle()
    {
        ProcessWPPages::dispatch();
        ProcessWPPosts::dispatch();
    }
}
