<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ticker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->comment("ID from users table");
            $table->integer('ticker_id', false, true)->nullable()->default(null)->comment("ID from tickers table or null");
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('ticker_id')->references('id')
                ->on('tickers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('symbol',20);
            $table->unique(['user_id','symbol']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::dropIfExists('user_ticker');
    }
}
