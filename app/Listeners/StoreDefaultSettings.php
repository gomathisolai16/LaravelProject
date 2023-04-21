<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Services\SettingService;
use Illuminate\Support\Facades\DB;

class StoreDefaultSettings
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
        if (!count($event->getUser()->settings)) {
            $id = $event->getUser()->id;

            $insertData = [
                [
                    'user_id' => $id,
                    'title' => 'Color Theme',
                    'key' => 'color_theme',
                    'value' => 1
                ],
                [
                    'user_id' => $id,
                    'title' => 'Audio News Alert',
                    'key' => 'audio_news_alert',
                    'value' => 0
                ],
                [
                    'user_id' => $id,
                    'title' => 'Font Size',
                    'key' => 'font_size',
                    'value' => 'small'
                ],
                [
                    'user_id' => $id,
                    'title' => 'Active Dashboard',
                    'key' => 'active_dashboard',
                    'value' => 1
                ],
                [
                    'user_id' => $id,
                    'title' => 'Headlines Only',
                    'key' => 'headlines_only',
                    'value' => 0
                ],
                [
                    'user_id' => $id,
                    'title' => 'Alerts',
                    'key' => 'alerts',
                    'value' => 0
                ],
                [
                    'user_id' => $id,
                    'title' => 'Instance Message Service',
                    'key' => 'instance_message_service',
                    'value' => 'ice'
                ],
                [
                    'user_id' => $id,
                    'title' => 'Email Alerts Last Tracked News Id',
                    'key' => 'email_alert_watchlist_last_news_id',
                    'value' => null,
                ],
                [
                    'user_id' => $id,
                    'title' => 'Timezone',
                    'key' => 'timezone',
                    'value' => null,
                ]
            ];

            $subscriptions = $event->getUserData('subscriptions');

            if(null !== $subscriptions){
                $insertData[] = [
                    'user_id' => $id,
                    'title' => 'Subscriptions',
                    'key' => 'subscriptions',
                    'value' => json_encode($subscriptions),
                ];
            }else{
                $insertData[] = [
                    'user_id' => $id,
                    'title' => 'Subscriptions',
                    'key' => 'subscriptions',
                    'value' => '{"abbreviations":[]}'
                ];
            }

            DB::table('settings')->insert($insertData);
        }
    }
}
