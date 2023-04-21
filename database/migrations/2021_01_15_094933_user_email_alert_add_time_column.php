<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmailAlertAddTimeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_email_alert', function (Blueprint $table) {
            $table->enum('time', \App\Models\EmailAlerts::DAILY_TIME_OPTIONS)
                ->nullable()
                ->comment("Column will define exact time when 'Daily' alert will be fired");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_email_alert', function (Blueprint $table) {
            $table->dropColumn('time');
        });
    }
}
