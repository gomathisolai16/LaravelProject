<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideosSubscriptionRelatedCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent = \App\Models\Category::create([
            'title' => 'Videos',
            'abbreviation' => 'VIDE.MN',
            'description' => null,
            'active' => 1,
            'category_id' => 1,
            'subscription_id' => null
        ]);
        // Get susbcription record for Live Briefs Pro North America w/ Videos
        $record = \App\Models\Subscription::where('abbreviation', 'pro_na_vids')->first();
        \App\Models\Category::create([
            'title' => 'Bloomberg Video',
            'abbreviation' => 'BVID.MN',
            'description' => null,
            'active' => 1,
            'category_id' => $parent->id,
            'subscription_id' => $record ? $record->id : null
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Category::whereIn('abbreviation', ['VIDE.MN', 'BVID.MN'])->delete();
    }
}
