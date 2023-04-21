<?php

namespace App\Console\Commands;

use App\Models\EmailAlerts;
use App\Models\News;
use App\Models\Setting;
use App\Models\User;
use App\Services\EmailAlertService;
use App\Services\SettingService;
use Illuminate\Console\Command;

/**
 * Class EmailAlertHourly
 * @package App\Console\Commands
 */
class EmailAlertHourly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EmailAlertHourly:checknews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emailAlerts = EmailAlerts::where(['frequency' => 'hourly', 'enabled' => '1'])->with(['user'])->get();
        if (count($emailAlerts) > 0) {
            $alerts = [];
            foreach($emailAlerts as $record) {
                if ($record->user->status !== User::$_userDeactivatedStatuses) {
                   $alerts[] = ['data' => $record, 'userId' => $record->user->id];
                }
            }
            $emailService = new EmailAlertService();
            $emailService->handleEmailAlert($alerts);
        }
    }
}
