<?php

namespace App\Console\Commands;

use App\Models\Novel\Source;
use Illuminate\Console\Command;

class DailyScanStoriesFromSourcesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan-new-stories-from-sources';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $sources = Source::all();
        foreach ($sources as $source) {
            $source->scanNewStories();
        }
    }
}
