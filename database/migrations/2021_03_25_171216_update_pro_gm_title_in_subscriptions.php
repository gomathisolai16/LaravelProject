<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateProGmTitleInSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('subscriptions')
        ->where('abbreviation', 'pro_gm')
        ->update(['title' => 'Live Briefs Pro Global Markets']);;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('subscriptions')->truncate();
    }
}
