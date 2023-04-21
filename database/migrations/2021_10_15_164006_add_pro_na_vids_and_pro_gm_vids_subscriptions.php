<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProNaVidsAndProGmVidsSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Subscription::insert([
            [
                'abbreviation' => 'pro_na_vids',
                'title' => 'Live Briefs Pro North America w/ Videos'
            ],
            [
                'abbreviation' => 'pro_gm_vids',
                'title' => 'Live Briefs Pro Global Markets w/ Videos'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Subscription::whereIn('abbreviation', ['pro_na_vids', 'pro_gm_vids'])->delete();
    }
}
