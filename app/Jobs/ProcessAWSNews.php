<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\News;
use App\Services\NewsService;
use App\Services\XMLParseService;
use Carbon\Carbon;

class ProcessAWSNews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param \Illuminate\Queue\Jobs\Job  $job
     * @param array $data
     *
     * @see \Illuminate\Queue\CallQueuedHandler::call()
     * @return bool
     */
    public function handle($job, $data)
    {
        ob_start();

//        echo "ProcessAWSNews handler\n\n";
//        echo date('Y-m-d :i:s');
//        echo "\n==========================\n";
        ob_flush();

        // Get file name from incoming data
        if(isset($data['Records']) && is_array($data['Records'])) {
            foreach ($data['Records'] as $row) {
                if(!empty($row['s3']['object']['key'])) {
                    echo "file: {$row['s3']['object']['key']}\n";
                    ob_flush();

                    // Two options:
                    // 1) Execute cli command
                    // $exitCode = Artisan::call('news:queue '.$row['s3']['object']['key'], [
                    //     'user' => 1, '--queue' => 'default'
                    // ]);

                    // echo \exec("php artisan news:queue {{$row['s3']['object']['key']}}");

                    // 2) Use handler directly
                    $this->process($row['s3']['object']['key']);
                }
            }

        }

        if (! $job->isDeletedOrReleased()) {
            $job->delete();
        }

        ob_flush();
        ob_end_clean();

        return true;
    }

    /**
     * Process news file
     * @param $data
     */
    public static function process($data)
    {
        ob_start();

        echo "Processing file: {$data}\n";

        $xmlParser = new XMLParseService();
        $xmlParser->parseXMLDataOneFile(true, $data);

        ob_flush();
        ob_end_clean();
    }
}
