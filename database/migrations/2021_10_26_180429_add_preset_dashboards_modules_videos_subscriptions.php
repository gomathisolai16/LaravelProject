<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPresetDashboardsModulesVideosSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $bloombergVideoCategory = \App\Models\Category::where('abbreviation', 'BVID.MN')->first();
        $northAmericaVideoSubscription = \App\Models\Subscription::where('abbreviation', 'pro_na_vids')->first();
        if (isset($northAmericaVideoSubscription)) {
            $northAmericaVideoDashboard = \App\Models\Dashboard::create([
                'user_id' => 1,
                'abbreviation' => 'north-america-w/-videos',
                'name' => 'North America w/ Videos',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'subscription_id' => $northAmericaVideoSubscription->id
            ]);

            if ($northAmericaVideoDashboard) {
                $lastAddedModule = \App\Models\Module::latest()->first();
                $northAmericaVideoModule = \App\Models\Module::create([
                    'user_id' => 1,
                    'abbreviation' => 'video-north-america',
                    'name' => 'Video North America',
                    'sort_order' => $lastAddedModule->sort_order + 1,
                    'active' => 1,
                    'public' => 1,
                    'preset' => 1,
                    'watch_list'=> null,
                    'subscription_id' => $northAmericaVideoSubscription->id
                ]);
                if ($northAmericaVideoModule) {
                    \DB::table('module_dashboard')->insert([
                        [
                            'dashboard_id' => $northAmericaVideoDashboard->id,
                            'module_id' => $northAmericaVideoModule->id,
                            'pos_x' => 1,
                            'pos_y' => 1,
                            'width' => 1,
                            'height' => 1
                        ]
                    ]);
                }
                if ($northAmericaVideoModule && $bloombergVideoCategory) {
                    \DB::table('module_category')->insert([
                        [
                            'module_id' => $northAmericaVideoModule->id,
                            'category_id' => $bloombergVideoCategory->id
                        ]
                    ]);

                }
            }
        }

        $globalMarketVideoSubscription = \App\Models\Subscription::where('abbreviation', 'pro_gm_vids')->first();
        if (isset($globalMarketVideoSubscription)) {
            $globalMarketVideoDashboard = \App\Models\Dashboard::create([
                'user_id' => 1,
                'abbreviation' => 'global-market-w/-videos',
                'name' => 'Global Market w/ Videos',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'subscription_id' => $globalMarketVideoSubscription->id
            ]);

            if ($globalMarketVideoDashboard) {
                $lastAddedModule = \App\Models\Module::latest()->first();
                $globalMarketVideoModule = \App\Models\Module::create([
                    'user_id' => 1,
                    'abbreviation' => 'video-global-market',
                    'name' => 'Video Global Market',
                    'sort_order' => $lastAddedModule->sort_order + 1,
                    'active' => 1,
                    'public' => 1,
                    'preset' => 1,
                    'watch_list'=> null,
                    'subscription_id' => $globalMarketVideoSubscription->id
                ]);
                if ($globalMarketVideoModule) {
                    \DB::table('module_dashboard')->insert([
                        [
                            'dashboard_id' => $globalMarketVideoDashboard->id,
                            'module_id' => $globalMarketVideoModule->id,
                            'pos_x' => 1,
                            'pos_y' => 1,
                            'width' => 1,
                            'height' => 1
                        ]
                    ]);
                }
                if ($globalMarketVideoModule && $bloombergVideoCategory) {
                    \DB::table('module_category')->insert([
                        [
                            'module_id' => $globalMarketVideoModule->id,
                            'category_id' => $bloombergVideoCategory->id
                        ]
                    ]);
                }
            }
        }
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
