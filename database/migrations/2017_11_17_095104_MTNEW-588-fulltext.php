<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class MTNEW588Fulltext extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `tbl_news` ADD FULLTEXT `news_title_fulltext_index` (`title`)");
        DB::statement("ALTER TABLE `tbl_news` ADD FULLTEXT `news_description_fulltext_index` (`description`)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = "ALTER TABLE `tbl_news` DROP INDEX `news_title_fulltext_index`, DROP INDEX `news_description_fulltext_index`;";
        DB::statement($sql);
    }
}
