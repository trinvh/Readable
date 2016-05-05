<?php

namespace App\Console\Commands;

use App\Models\Novel\Story;
use Illuminate\Console\Command;

class DailyUpdateStoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-story';

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
        $stories = Story::has('sources')->orderBy('updated_at', 'asc')->get();

        foreach ($stories as $story) {
            $source = $story->sources->first();
            $source->updateStoryInfo($story);
        }
    }
}
