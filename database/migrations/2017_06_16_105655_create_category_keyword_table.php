<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_keyword', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id', false, true)->comment("ID from categories table");
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('keyword_id', false, true)->comment("ID from keywords table");
            $table->foreign('keyword_id')->references('id')
                ->on('keywords')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_keyword');
    }
}
