<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('subscriptions')->insert([
            [
                'abbreviation' => 'free',
                'title' => 'Free',
            ],
            [
                'abbreviation' => 'pro',
                'title' => 'Live Briefs Pro North America',
            ],
            [
                'abbreviation' => 'pro_gm',
                'title' => 'Live Briefs Pro Global Market',
            ],

        ]);
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
