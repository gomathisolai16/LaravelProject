<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Repository as Cache;

/**
 * CLI command
 * php artisan news:work
 *
 * @package App\Console\Commands
 */
class NewsWork extends \Illuminate\Queue\Console\WorkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:work
                            {connection? : The name of the queue connection to work}
                            {--queue= : The names of the queues to work}
                            {--daemon : Run the worker in daemon mode (Deprecated)}
                            {--once : Only process the next job on the queue}
                            {--delay=0 : The number of seconds to delay failed jobs}
                            {--force : Force the worker to run even in maintenance mode}
                            {--memory=128 : The memory limit in megabytes}
                            {--sleep=3 : Number of seconds to sleep when no job is available}
                            {--timeout=60 : The number of seconds a child process can run}
                            {--tries=0 : Number of times to attempt a job before logging it failed}
                            {--stop-when-empty : Stop when the queue is empty}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start processing news jobs on the queue as a daemon';

    /**
     * Create a new queue work command.
     *
     * @param  \App\Jobs\NewsWorker $worker
     * @return void
     */
    public function __construct(\App\Jobs\NewsWorker $worker)
    {
        parent::__construct($worker, app(Cache::class));
    }
}
