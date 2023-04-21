<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * CLI command
 * php artisan news:queue {file_name}
 *
 * @package App\Console\Commands
 */
class NewsQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:queue {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process news from file';

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
        $fileName = $this->argument('file');
        $this->info("Cli processing: {$fileName}");
        
        //app()->make('App\Jobs\ProcessAWSNews')->process($fileName);
        \App\Jobs\ProcessAWSNews::process($fileName);

        return 0;
    }
}
