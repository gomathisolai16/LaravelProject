<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreRoleForUser
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
        $status = $event->getUserData('status');
        if ($status === 'regular') {
            $event->getUser()->attachRole(Role::where('name', '=', 'regular-user')->first());
        } elseif ($status === 'admin') {
            $event->getUser()->attachRole(Role::where('name', '=', 'admin-user')->first());
        } elseif ($status === 'advanced') {
            $event->getUser()->attachRole(Role::where('name', '=', 'advanced-user')->first());
        }
    }
}
