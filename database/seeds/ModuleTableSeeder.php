<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $counter = 0;
        //factory(\App\Models\Module::class,50)->create();
        \App\Models\Module::insert([
            [
                'user_id' => 1,
                'abbreviation' => "street-color",
                'name' => "Street Color",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "top-news",
                'name' => "Top News",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "oli-&-gas",
                'name' => "Oil & Gas",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "oli-market-updates",
                'name' => "Oil Market Updates",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "us-markets",
                'name' => "Global Economics",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            // US MARKET
            [
                'user_id' => 1,
                'abbreviation' => "all-news",
                'name' => "US Market News",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "analyst-upgrades",
                'name' => "Analyst Upgrades",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "analyst-downgrades",
                'name' => "Analyst Downgrades",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            //GLOBAL
            [
                'user_id' => 1,
                'abbreviation' => "middle-east",
                'name' => "Middle East",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "canadian-markets",
                'name' => "Canadian Markets",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "european-markets",
                'name' => "European Markets",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "asian-markets",
                'name' => "Asian Markets",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
            [
                'user_id' => 1,
                'abbreviation' => "commodity-news",
                'name' => "Commodity News",
                'sort_order' => $counter++,
                'active' => 1,
                'public' => 1,
                'preset' => 1,
                'watch_list'=> 0
            ],
        ]);
        $relationArray = [];
        $relationArray2 = [];
        $relationArray[] = [
            'module_id' => 1,
            'dashboard_id' => 1,
            'pos_x' => 4,
            'pos_y' => 2,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 2,
            'dashboard_id' => 1,
            'pos_x' => 2,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 3,
            'dashboard_id' => 1,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 4,
            'dashboard_id' => 1,
            'pos_x' => 3,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 5,
            'dashboard_id' => 1,
            'pos_x' => 4,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];

        //US MARKETS
        $relationArray[] = [
            'module_id' => 5,
            'dashboard_id' => 2,
            'pos_x' => 3,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 6,
            'dashboard_id' => 2,
            'pos_x' => 2,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 1,
            'dashboard_id' => 2,
            'pos_x' => 4,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 7,
            'dashboard_id' => 2,
            'pos_x' => 4,
            'pos_y' => 2,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 8,
            'dashboard_id' => 2,
            'pos_x' => 3,
            'pos_y' => 2,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 2,
            'dashboard_id' => 2,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        //GLOBAL
        $relationArray[] = [
            'module_id' => 2,
            'dashboard_id' => 3,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 5,
            'dashboard_id' => 3,
            'pos_x' => 2,
            'pos_y' => 1,
            'width' => 1,
            'height' => 2,
        ];
        $relationArray[] = [
            'module_id' => 9,
            'dashboard_id' => 3,
            'pos_x' => 4,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 10,
            'dashboard_id' => 3,
            'pos_x' => 3,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 11,
            'dashboard_id' => 3,
            'pos_x' => 3,
            'pos_y' => 2,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 12,
            'dashboard_id' => 3,
            'pos_x' => 4,
            'pos_y' => 2,
            'width' => 1,
            'height' => 1,
        ];
        //CANADIAN
        $relationArray[] = [
            'module_id' => 10,
            'dashboard_id' => 4,
            'pos_x' => 3,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 5,
            'dashboard_id' => 4,
            'pos_x' => 2,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 3,
            'dashboard_id' => 4,
            'pos_x' => 4,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 7,
            'dashboard_id' => 4,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray[] = [
            'module_id' => 12,
            'dashboard_id' => 4,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        //commodity
        $relationArray[] = [
            'module_id' => 13,
            'dashboard_id' => 5,
            'pos_x' => 1,
            'pos_y' => 1,
            'width' => 1,
            'height' => 1,
        ];
        $relationArray2[] = [
            'module_id' => 1,
            'category_id' => 101,
        ];
        $relationArray2[] = [
            'module_id' => 1,
            'category_id' => 103,
        ];
        $relationArray2[] = [
            'module_id' => 2,
            'category_id' => 72,
        ];
        $relationArray2[] = [
            'module_id' => 3,
            'category_id' => 22,
        ];
        $relationArray2[] = [
            'module_id' => 4,
            'category_id' => 68,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 78,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 79,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 80,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 81,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 82,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 83,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 84,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 85,
        ];
        $relationArray2[] = [
            'module_id' => 5,
            'category_id' => 86,
        ];
        $relationArray2[] = [
            'module_id' => 6,
            'category_id' => 12,
        ];
        $relationArray2[] = [
            'module_id' => 7,
            'category_id' => 74,
        ];
        $relationArray2[] = [
            'module_id' => 8,
            'category_id' => 75,
        ];
        $relationArray2[] = [
            'module_id' => 9,
            'category_id' => 19,
        ];
        $relationArray2[] = [
            'module_id' => 10,
            'category_id' => 13,
        ];
        $relationArray2[] = [
            'module_id' => 11,
            'category_id' => 18,
        ];
        $relationArray2[] = [
            'module_id' => 12,
            'category_id' => 16,
        ];
        $relationArray2[] = [
            'module_id' => 13,
            'category_id' => 33,
        ];
        $relationArray2[] = [
            'module_id' => 13,
            'category_id' => 13,
        ];

        \DB::table('module_dashboard')->insert($relationArray);
        \DB::table('module_category')->insert($relationArray2);
    }
}
