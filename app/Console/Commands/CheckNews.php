<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Services\NewsService;
use App\Services\XMLParseService;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class CheckNews
 * @package App\Console\Commands
 */
class CheckNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckNews:getnews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $xmlParser = new XMLParseService();
        $xmlParser->parseXMLData();
    }


}
