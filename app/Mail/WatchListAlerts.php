<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WatchListAlerts extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $watchListNews;
    public $topNews;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $watchList
     * @param $top
     */
    public function __construct(User $user, $watchList, $top)
    {
        $this->user = $user;
        $this->watchListNews = $watchList;
        $this->topNews = $top;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_EMAIL'))
            ->subject("WatchList Alerts")
            ->view('partials.mail._alertEmailTemplate');
    }
}
