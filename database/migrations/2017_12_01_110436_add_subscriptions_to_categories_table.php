<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Category::where('id','=',72)
        ->update(['subscription_id' => 1]);

        \App\Models\Category::whereIn('category_id',[6,7,47])
            ->update(['subscription_id' => 1]);

        \App\Models\Category::whereIn('category_id',[2,3,4,5,8,9,10,11,73,79])->where('id','!=',14)->where('id','!=',72)
            ->update(['subscription_id' => 2]);

        \App\Models\Category::where('id','=',14)
            ->update(['subscription_id' => 3]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
