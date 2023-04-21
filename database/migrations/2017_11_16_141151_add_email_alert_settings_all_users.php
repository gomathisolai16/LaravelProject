<?php

use App\Models\Setting;
use App\Models\User;
use App\Services\SettingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailAlertSettingsAllUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = User::all();
        foreach ($users as $user) {
            $emailAlert = Setting::where(['key' => 'email_alert_option','user_id' => $user->id])->first();
            if (!$emailAlert) {
                $setting = new Setting();
                $setting->user_id = $user->id;
                $setting->key = 'email_alert_option';
                $setting->title = 'Email Alerts Settings';
                $setting->value = 'daily';
                $setting->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
