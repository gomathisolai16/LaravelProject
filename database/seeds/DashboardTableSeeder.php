<?php

use Illuminate\Database\Seeder;

class DashboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Models\Dashboard::class,50)->create();
        \App\Models\Dashboard::insert([
            [
                'user_id' => 1,
                'abbreviation' => 'oil-energy',
                'name' => 'Oil / Energy',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
            ],
            [
                'user_id' => 1,
                'abbreviation' => 'us-markets',
                'name' => 'US Markets',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
            ],
            [
                'user_id' => 1,
                'abbreviation' => 'global-markets',
                'name' => 'Global Markets',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
            ],
            [
                'user_id' => 1,
                'abbreviation' => 'canadian-markets',
                'name' => 'Canadian Markets',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
            ],
            [
                'user_id' => 1,
                'abbreviation' => 'commodity',
                'name' => 'Commodity',
                'active' => 1,
                'public' => 1,
                'preset' => 1,
            ],

        ]);

        \Illuminate\Support\Facades\DB::table('user_dashboard')->insert([
            [
                "user_id"=>1,
                "dashboard_id"=>1,
            ],
            [
                "user_id"=>1,
                "dashboard_id"=>2,
            ],
            [
                "user_id"=>1,
                "dashboard_id"=>3,
            ],
            [
                "user_id"=>1,
                "dashboard_id"=>4,
            ],
            [
                "user_id"=>1,
                "dashboard_id"=>5,
            ],
            [
                "user_id"=>2,
                "dashboard_id"=>1,
            ],
            [
                "user_id"=>2,
                "dashboard_id"=>2,
            ],
            [
                "user_id"=>3,
                "dashboard_id"=>1,
            ],
            [
                "user_id"=>3,
                "dashboard_id"=>2,
            ],
        ]);

    }
}
