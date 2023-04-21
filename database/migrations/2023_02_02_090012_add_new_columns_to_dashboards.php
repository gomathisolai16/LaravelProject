<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToDashboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dashboards', function (Blueprint $table) {
            $table->string('name_jp')->nullable()->after('name');
            $table->string('name_ch_s')->nullable()->after('name_jp');  //Simplified chinese 
            $table->string('name_ch_t')->nullable()->after('name_ch_s');  // Traditional chinese
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dashboards', function (Blueprint $table) {
            $table->dropColumn('name_jp');
            $table->dropColumn('name_ch_s');
            $table->dropColumn('name_ch_t');
        });
    }
}
