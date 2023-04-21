<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_ticker', function (Blueprint $table) {
            $table->integer('new_id', false, true)->comment('ID from news table');
            $table->integer('ticker_id', false, true)->comment('ID from tickers table');
            $table->foreign('new_id')->references('id')
                ->on('news')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('ticker_id')->references('id')
                ->on('tickers')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('new_ticker');
    }
}
