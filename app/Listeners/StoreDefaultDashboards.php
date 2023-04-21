<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use Illuminate\Support\Facades\DB;

class StoreDefaultDashboards
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
     * @param  UserCreatedEvent $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        if (!count($event->getUser()->filterActiveDashboards())) {
            $id = $event->getUser()->id;
            DB::table('user_dashboard')->insert([
                [
                    'user_id' => $id,
                    'dashboard_id' => 1,
                ],
                [
                    'user_id' => $id,
                    'dashboard_id' => 2,
                ]
            ]);
        }
    }
}
