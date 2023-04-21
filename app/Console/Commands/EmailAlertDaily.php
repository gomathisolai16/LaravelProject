<?php

namespace App\Console\Commands;

use App\Models\EmailAlerts;
use App\Models\News;
use App\Models\Setting;
use App\Models\User;
use App\Services\EmailAlertService;
use App\Services\SettingService;
use Illuminate\Console\Command;
use Log;

/**
 * Class EmailAlertDaily
 * @package App\Console\Commands
 */
class EmailAlertDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'EmailAlertDaily:checknews {time}';

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
        $time = $this->argument('time');
        Log::info('Checking daily email alerts for time: ' . $time);
        $emailAlerts = EmailAlerts::where(['frequency' => 'daily', 'enabled' => '1', 'time' => $time])->with(['user'])->get();
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
