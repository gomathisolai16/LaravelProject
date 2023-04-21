<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEmailAlertModuleIdForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_email_alert', function (Blueprint $table) {
            \DB::statement("ALTER TABLE `" . \DB::getTablePrefix() . "user_email_alert` CHANGE `module_id` `module_id` INT(10) UNSIGNED NOT NULL");
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
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
            $table->dropForeign('user_email_alert_module_id_foreign');
        });
    }
}
