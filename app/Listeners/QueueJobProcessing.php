<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class QueueJobProcessing
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  JobProcessing $event
     * @return void
     */
    public function handle(JobProcessing $event)
    {
        // $event->connectionName
        // $event->job
        // $event->job->payload()

        /** @var \Illuminate\Queue\Jobs\Job $job */
        $job = $event->job;
        $queue = $job->getQueue();

        // SQS queue is not added by Laravel. So custom handler needed
        $tmp = trim(env('SQS_PREFIX', '').'/'.env('SQS_QUEUE', ''));
        if($tmp != '/' && $event->connectionName == 'sqs' && $queue == $tmp) {

            $payload = $job->payload();

            /** @var \Monolog\Logger $log */
            //$log = Log::getMonolog();
//            $log = new \Monolog\Logger('SQS job', [
//                new StreamHandler(storage_path().'/logs/sqs-queue.log', Logger::INFO, false)
//            ]);
//            //$log->pushHandler();
//            $log->info(json_encode($payload));

            // Log data for SQS news queue to file
            file_put_contents(storage_path().'/logs/sqs-queue-'.date('Y-m-d').'.log',
                '['.date('Y-m-d H:i:s').'] '.json_encode($payload)."\n\n", FILE_APPEND);
        }
    }
}
