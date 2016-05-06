<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class QueuesListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start-queue-listener';

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
        $path = base_path();
        if (file_exists($path . '/queue.pid')) {
            $pid    = file_get_contents($path . '/queue.pid');
            $result = exec("ps -p $pid --no-heading | awk '{print $1}'");
            $run    = $result == '' ? true : false;
        } else {
            $run = true;
        }
        if ($run) {
            $command = '/usr/bin/php -c ' . $path . '/php.ini ' . $path . '/artisan queue:listen -queues:high,medium,low --tries=2 > /dev/null & echo $!';
            $number  = exec($command);
            file_put_contents($path . '/queue.pid', $number);
        }
    }
}
