<?php

namespace App\Console\Commands;

use App\Services\NewsService;
use Illuminate\Console\Command;

/**
 * Class RemoveOldNews
 * @package App\Console\Commands
 */
class RemoveOldNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveOldNews:olderthenyear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete news that are older than 1 year';

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
        // if news alder then NEWS_LIVE_PERIOD days then remove them
        NewsService::removeNewsOlderThen(env('NEWS_LIVE_PERIOD', 120));
    }
}
