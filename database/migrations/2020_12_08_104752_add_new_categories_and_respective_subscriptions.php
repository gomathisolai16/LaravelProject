<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewCategoriesAndRespectiveSubscriptions extends Migration
{
    // Database ID for the 'Live Briefs Pro North America' subscription level (change if needed)
    const SUBSCRIPTION_PRO_NORTH_AMERICA = 2;
    // Database ID for the 'Live Briefs Pro Global Market' subscription level (change if needed)
    const SUBSCRIPTION_PRO_GLOBAL_MARKET = 3;
    // Database ID for the 'Industry' category (change if needed)
    const INDUSTRY_CATEGORY = 3;
    const INDUSTRY_NEW_CHILDREN_CATEGORIES = [
        [
            'title' => 'Infrastructure',
            'abbreviation' => 'INFR.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Manufacturing',
            'abbreviation' => 'MAFC.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Real Estate',
            'abbreviation' => 'RLES.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Automotive',
            'abbreviation' => 'AUMO.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Aerospace',
            'abbreviation' => 'ARSP.MN',
            'description' => null,
            'active' => 1
        ]
    ];
    // Database ID for the 'Event News' category (change if needed)
    const EVENT_NEWS = 8;
    CONST EVENT_NEWS_NEW_CHILDREN_CATEGORIES = [
        [
            'title' => 'Bankruptcy / Liquidation',
            'abbreviation' => 'BKLQ.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Minority Stake Deals',
            'abbreviation' => 'MNSD.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Restructuring',
            'abbreviation' => 'RSTR.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Delisting',
            'abbreviation' => 'DLST.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Deal Termination',
            'abbreviation' => 'DTRM.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Property Transaction',
            'abbreviation' => 'PTRN.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Loans / Revolvers',
            'abbreviation' => 'LNRV.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Operations Update',
            'abbreviation' => 'OPUP.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Green Initiatives',
            'abbreviation' => 'GNIT.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Mining & Exploration',
            'abbreviation' => 'MNEX.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Drug Updates',
            'abbreviation' => 'DGUP.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'FDA Approval / Rejections',
            'abbreviation' => 'FDAR.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Shareholder Activism',
            'abbreviation' => 'SHCT.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Credit Ratings',
            'abbreviation' => 'CDRT.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Name Change',
            'abbreviation' => 'NMCG.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Geopolitics / Market News',
            'abbreviation' => 'GPMK.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Trading Update',
            'abbreviation' => 'TDUP.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'New Projects / Ventures',
            'abbreviation' => 'NEWPV.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Staffing / Job Cuts',
            'abbreviation' => 'JOBL.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'First Oil Chat',
            'abbreviation' => 'FOCH.MN',
            'description' => null,
            'active' => 1
        ],
    ];
    // Database ID for the 'Global Region - Europe' category (change if needed)
    const GLOBAL_REGION_EUROPE = 18;
    const GLOBAL_REGION_NEW_CHILDREN_CATEGORIES = [
        [
            'title' => 'Austria',
            'abbreviation' => 'RAUT.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Belgium',
            'abbreviation' => 'RBEL.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Denmark',
            'abbreviation' => 'RDNK.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Finland',
            'abbreviation' => 'RFIN.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Ireland',
            'abbreviation' => 'RIRL.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Netherlands',
            'abbreviation' => 'RNLD.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Norway',
            'abbreviation' => 'RNOR.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Poland',
            'abbreviation' => 'RPOL.MN',
            'description' => null,
            'active' => 1
        ],
        [
            'title' => 'Portugal',
            'abbreviation' => 'RPRT.MN',
            'description' => null,
            'active' => 1
        ]
    ];
    // Database ID for the 'Market Summary' category (change if needed) 
    const MARKET_SUMMARY = 6;
    const MARKET_SUMMARY_NEW_CHILDREN_CATEGORIES = [
        [
            'title' => 'Regional Broad Market Summary - USA',
            'abbreviation' => 'GMUS.MN',
            'description' => null,
            'active' => 1
        ]
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Category::insert(array_map(function($record) {
            $record['category_id'] = self::INDUSTRY_CATEGORY;
            $record['subscription_id'] = self::SUBSCRIPTION_PRO_NORTH_AMERICA;
            return $record;
        }, self::INDUSTRY_NEW_CHILDREN_CATEGORIES));

        \App\Models\Category::insert(array_map(function($record) {
            $record['category_id'] = self::EVENT_NEWS;
            $record['subscription_id'] = self::SUBSCRIPTION_PRO_NORTH_AMERICA;
            return $record;
        }, self::EVENT_NEWS_NEW_CHILDREN_CATEGORIES));

        \App\Models\Category::insert(array_map(function ($record) {
            $record['category_id'] = self::GLOBAL_REGION_EUROPE;
            $record['subscription_id'] = self::SUBSCRIPTION_PRO_GLOBAL_MARKET;
            return $record;
        }, self::GLOBAL_REGION_NEW_CHILDREN_CATEGORIES));

        \App\Models\Category::insert(array_map(function ($record) {
            $record['category_id'] = self::MARKET_SUMMARY;
            $record['subscription_id'] = self::SUBSCRIPTION_PRO_NORTH_AMERICA;
            return $record;
        }, self::MARKET_SUMMARY_NEW_CHILDREN_CATEGORIES));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Category::whereIn('abbreviation', array_map(function($record) {
            return $record['abbreviation'];
        }, self::INDUSTRY_NEW_CHILDREN_CATEGORIES))->delete();

        \App\Models\Category::whereIn('abbreviation', array_map(function($record) {
            return $record['abbreviation'];
        }, self::EVENT_NEWS_NEW_CHILDREN_CATEGORIES))->delete();

        \App\Models\Category::whereIn('abbreviation', array_map(function($record) {
            return $record['abbreviation'];
        }, self::GLOBAL_REGION_NEW_CHILDREN_CATEGORIES))->delete();

        \App\Models\Category::whereIn('abbreviation', array_map(function ($record) {
            return $record['abbreviation'];
        }, self::MARKET_SUMMARY_NEW_CHILDREN_CATEGORIES))->delete();
    }
}
