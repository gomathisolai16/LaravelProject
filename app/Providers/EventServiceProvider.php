<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserCreatedEvent' => [
            'App\Listeners\StoreDefaultSettings',
            'App\Listeners\StoreDefaultDashboards',
            'App\Listeners\StoreRoleForUser',
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\RevokeOldTokens'
        ],
/*        'App\Events\GenerateUserToken' => [
            'App\Listeners\RemovePreviousAccessTokens'
        ],*/

        'App\Events\ImageAttachedToNews' => [
            'App\Listeners\GenerateXMLForNews'
        ],

        'Illuminate\Queue\Events\JobProcessing' => [
            'App\Listeners\QueueJobProcessing'
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
