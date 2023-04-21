<?php

use App\Models\UserWatchList;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdUserWatchListTable extends Migration
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
            DB::table('user_watch_list')->insert(
                ['user_id' => $user->id]
            );
        }

        $userWatchList = DB::table('user_watch_list')->get();
        foreach ($userWatchList as $item) {
            DB::table('user_ticker')
                ->where('user_id', '=', $item->user_id)
                ->where('watch_list_id', '=', null)
                ->update(array('watch_list_id' => $item->id));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_watch_list');
        $userTickers = DB::table('user_ticker')->get();
        foreach ($userTickers as $item) {
            DB::table('user_ticker')
                ->where('watch_list_id', '!=', null)
                ->update(array('watch_list_id' => null));
        }
    }
}
