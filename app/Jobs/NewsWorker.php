<?php

namespace App\Jobs;

use Illuminate\Queue\Worker;
use Illuminate\Queue\WorkerOptions;
use Illuminate\Contracts\Queue\Factory as QueueManager;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Debug\ExceptionHandler;

/**
 * Class NewsWorker
 *
 * Amazon SQS news queue worker. Can be used as daemon.
 *
 * @package App\Jobs
 */
class NewsWorker extends Worker
{
    public function __construct(QueueManager $manager, Dispatcher $events, ExceptionHandler $exceptions)
    {
        parent::__construct($manager, $events, $exceptions, function() {
            // Worker will always be available and never stop execution for being in maintenance
            return false;
        });
    }

    /**
     * Process the given job from the queue.
     *
     * @param  string  $connectionName
     * @param  \Illuminate\Queue\Jobs\Job  $job
     * @param  \Illuminate\Queue\WorkerOptions  $options
     * @return void
     *
     * @throws \Throwable
     */
    public function process($connectionName, $job, WorkerOptions $options)
    {
        $queue = $job->getQueue();

        // SQS queue is not added by Laravel. So custom handler needed
        $tmp = trim(env('SQS_PREFIX', '').'/'.env('SQS_QUEUE', ''));
        if($tmp != '/' && $connectionName == 'sqs' && $queue == $tmp) {
            $payload = $job->payload();

            // If 'job' and 'data' are present in $payload - job can be processed by usual way
            // Else we need Decorator
            if(empty($payload['job'])) {
                // Adjust job format to Laravel requirements
                $payload = [
                    'job'  => 'App\Jobs\ProcessAWSNews@handle',
                    'data' => $payload
                ];

                $job = new \App\Jobs\Decorator($job, $payload);
            }
        }

        parent::process($connectionName, $job, $options);
    }
}