<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEmailAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_email_alert', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('module_id');
            $table->enum('frequency', ['daily', 'hourly'])->default('daily');
            $table->tinyInteger('enabled')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_email_alert');
    }
}
