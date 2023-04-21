<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlterColumnUserTickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_ticker', function($table) {
            $table->integer('watch_list_id', false, true)->nullable();
            $table->foreign('watch_list_id')
                ->references('id')
                ->on('user_watch_list')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_ticker', function (Blueprint $table) {
            $table->dropForeign('watch_list_id');
            $table->dropColumn('watch_list_id');
        });
    }
}
