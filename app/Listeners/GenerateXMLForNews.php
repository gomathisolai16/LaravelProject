<?php

namespace App\Listeners;

use App\Events\ImageAttachedToNews;
use App\Services\FTPSendService;
use App\Services\XMLGenerateService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateXMLForNews
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageAttachedToNews $event
     * @return void
     * @throws \Exception
     */
    public function handle(ImageAttachedToNews $event)
    {
        // generate XML files and send by FTP only for production server
        $service = new XMLGenerateService($event->getNews());
        $filename = $service->getGeneratedXMLFileName();
        if (in_array(\App::environment(), explode(',', env('FTP_HOST_ENVS')))) {

            $ftp = new FTPSendService(
                env('FTP_HOST', 'ftp.midnighttrader.com'),
                env('FTP_USER', 'scopic'),
                env('FTP_PASS', 'fk023k#fq!z'),
                env('FTP_PORT', 21)
            );
            $ftp->upload(env('FTP_PATH') . '/' . $filename, $service->getPath() . '/' . $filename);
        }
    }
}
