<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class W588 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->index('release_date');
        });

        Schema::table('new_category', function (Blueprint $table) {
            $table->index(['new_id', 'category_id']);
        });

        Schema::table('module_category', function (Blueprint $table) {
            $table->index(['module_id', 'category_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropIndex(['release_date']);
        });

        Schema::table('new_category', function (Blueprint $table) {
            $table->dropIndex(['new_id', 'category_id']);
        });

        Schema::table('module_category', function (Blueprint $table) {
            $table->dropIndex(['module_id', 'category_id']);
        });
    }
}
