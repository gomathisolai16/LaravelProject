<?php

namespace App\Jobs;

use Illuminate\Container\Container;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Contracts\Queue\Job as JobContract;

/**
 * \Illuminate\Queue\Jobs\Job Class Decorator
 * Can be used to process job tasks created by third party applications
 *
 * @package App\Jobs
 */
class Decorator extends Job implements JobContract
{
    /**
     * @var \Illuminate\Queue\Jobs\Job
     */
    protected $job;

    protected $payload = null;

    /**
     * Create a new job instance.
     *
     * @param  Job $job
     * @param array $payload custom payload
     * It will override original job payload and should have format:
     *
     * [
     * 'job'  => 'App\Jobs\ProcessAWSNews@handle',
     * 'data' => ['qwe'=>123, 'asd'=>456]
     * ];
     *
     * where:
     * - job - Job (handler) class with method (separated by '@')
     * - data - job data
     */
    public function __construct(Job $job, $payload = null)
    {
        $this->job = $job;
        $this->payload = $payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Release the job back into the queue.
     *
     * @param  int  $delay
     * @return mixed
     */
    public function release($delay = 0)
    {
        return $this->job->release($delay);
    }

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete()
    {
        $this->job->delete();
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        return (int) $this->job->attempts();
    }

    /**
     * Get the job identifier.
     *
     * @return string
     */
    public function getJobId()
    {
        return $this->job->getJobId();
    }

    /**
     * Get the raw body string for the job.
     * Overrides original raw body string
     *
     * @return string
     */
    public function getRawBody()
    {
        if(!is_null($this->payload)) return \json_encode($this->payload);

        return $this->job->getRawBody();
    }

    /**
     * Lets leave it to parent class
     * Fire the job.
     * @return void
     */
    //public function fire() { }

    /**
     * Determine if the job has been deleted.
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->job->isDeleted();
    }

    /**
     * Determine if the job was released back into the queue.
     *
     * @return bool
     */
    public function isReleased()
    {
        return $this->job->isReleased();
    }

    /**
     * Determine if the job has been deleted or released.
     *
     * @return bool
     */
    public function isDeletedOrReleased()
    {
        return $this->job->isDeletedOrReleased();
    }

    /**
     * Determine if the job has been marked as a failure.
     *
     * @return bool
     */
    public function hasFailed()
    {
        return $this->job->hasFailed();
    }

    /**
     * Mark the job as "failed".
     *
     * @return void
     */
    public function markAsFailed()
    {
        $this->job->markAsFailed();
    }

    /**
     * Process an exception that caused the job to fail.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function failed($e)
    {
        $this->job->failed($e);
    }

    /**
     * Resolve the given class.
     *
     * @param  string  $class
     * @return mixed
     */
    protected function resolve($class)
    {
        return $this->job->resolve($class);
    }

    /**
     * Get the decoded body of the job.
     * Overrides original job payload by new one
     *
     * @return array
     */
    public function payload()
    {
        if(!is_null($this->payload)) return $this->payload;

        return $this->job->payload();
    }

    /**
     * The number of times to attempt a job.
     *
     * @return int|null
     */
    public function maxTries()
    {
        return $this->job->maxTries();
    }

    /**
     * The number of seconds the job can run.
     *
     * @return int|null
     */
    public function timeout()
    {
        return $this->job->timeout();
    }

    /**
     * Lets leave it to parent class
     *
     * Get the name of the queued job class.
     *
     * @return string
     */
    //public function getName() { }

    /**
     * Lets leave it to parent class
     *
     * Get the resolved name of the queued job class.
     * Resolves the name of "wrapped" jobs such as class-based handlers.
     *
     * @return string
     */
   // public function resolveName(){ }

    /**
     * Get the name of the connection the job belongs to.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return $this->job->getConnectionName();
    }

    /**
     * Get the name of the queue the job belongs to.
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->job->getQueue();
    }

    /**
     * Get the service container instance.
     *
     * @return \Illuminate\Container\Container
     */
    public function getContainer()
    {
        return $this->job->getContainer();
    }


    // Methods from Illuminate\Queue\Jobs\SqsJob
    /**
     * Get the underlying SQS client instance.
     *
     * @return \Aws\Sqs\SqsClient
     */
    public function getSqs()
    {
        return $this->job->getSqs();
    }

    /**
     * Get the underlying raw SQS job.
     *
     * @return array
     */
    public function getSqsJob()
    {
        return $this->job->getSqsJob();
    }
}
