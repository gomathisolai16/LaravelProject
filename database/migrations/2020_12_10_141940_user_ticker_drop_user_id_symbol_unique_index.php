<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTickerDropUserIdSymbolUniqueIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_ticker', function (Blueprint $table) {
            // Drop foreign key on column 'user_id' references column 'id' on 'users'
            $table->dropForeign('user_ticker_user_id_foreign');
            // Drop unique indexes including 'user_id' and 'symbol' columns
            $table->dropUnique('user_ticker_user_id_symbol_unique');
            // Define the new unique index including 'symbol' and 'watch_list_id'
            $table->unique(['symbol', 'watch_list_id']);
            // Re-add the dropped foreign key 
            $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::table('user_ticker', function (Blueprint $table) {
            $table->dropUnique('user_ticker_symbol_watch_list_id_unique');
            $table->unique(['user_id','symbol']);
        });
    }
}
