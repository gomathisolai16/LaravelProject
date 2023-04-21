<?php

namespace App\Listeners;

use App\Events\GenerateUserToken;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemovePreviousAccessTokens
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
     * @param  GenerateUserToken  $event
     * @return void
     */
    public function handle(GenerateUserToken $event)
    {
        $user = $event->getUser();
        //$user->tokens()->delete();
    }
}
