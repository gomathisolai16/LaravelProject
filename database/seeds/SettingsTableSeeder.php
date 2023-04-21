<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertData = [];
        $fontSizes = ['small','medium','large'];

        for ($i = 1; $i <= 5; $i++) {
            $insertData[] = [
                'user_id' => $i,
                'title'=>'Color Theme',
                'key' => 'color_theme',
                'value' => mt_rand(1, 2)
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Audio News Alert',
                'key' => 'audio_news_alert',
                'value' => mt_rand(0, 1)
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Font Size',
                'key' => 'font_size',
                'value' => $fontSizes[mt_rand(0, 2)]
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Active Dashboard',
                'key' => 'active_dashboard',
                'value' => 1
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Headlines Only',
                'key' => 'headlines_only',
                'value' => 0
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Alerts',
                'key' => 'alerts',
                'value' => 0
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Subscriptions',
                'key' => 'subscriptions',
                'value' => '{"abbreviations":[]}'
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Instance Message Service',
                'key' => 'instance_message_service',
                'value' => 'ice'
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Email Alerts Settings',
                'key' => 'email_alert_option',
                'value' => 'daily',
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Email Alerts Last Tracked News Id',
                'key' => 'email_alert_watchlist_last_news_id',
                'value' => null,
            ];
            $insertData[] = [
                'user_id' => $i,
                'title' => 'Timezone',
                'key' => 'timezone',
                'value' => null
            ];
        }

        \App\Models\Setting::insert($insertData);
    }
}
