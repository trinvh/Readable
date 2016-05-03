<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Novel\Story;
use App\Models\Novel\Category;
use App\Models\Novel\Source;
use App\Models\Novel\Author;
use App\Models\Novel\Tag;
use App\Models\Helpers\Html2Text;

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
        $stories = Story::has('sources')->whereDoesntHave('tags', function($q) {
            $q->where('name', 'Hoàn Thành');
        })->orderBy('updated_at', 'asc')->get();
        
        foreach($stories as $story) {
            $source = $story->sources->first();
            $source->updateStoryInfo($story);
        }
    }
}
