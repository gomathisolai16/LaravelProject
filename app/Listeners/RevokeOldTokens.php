<?php

namespace App\Listeners;

use App\Models\Token;
use Laravel\Passport\Client;
use Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevokeOldTokens
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
     * @param AccessTokenCreated $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $client = Client::find($event->clientId);
        // delete this client tokens created before
        $latest = Token::where('client_id', $client->id)
            ->where('user_id', $event->userId)
            ->orderBy('created_at','desc')
            ->first();

        $client->tokens()
            ->where('user_id', $event->userId)
            ->where('id', '!=', $latest->id)
            ->delete();
    }
}
