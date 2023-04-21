<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUserKeywordUserCategoryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_category');
        Schema::dropIfExists('user_keyword');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('user_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->comment("ID from users table");
            $table->integer('category_id', false, true)
                ->nullable()->comment("ID from categories table or null");
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('category');
            $table->unique(['user_id','category_id']);
        });

        Schema::create('user_keyword', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->comment("ID from users table");
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('keyword',50);
            $table->unique(['user_id','keyword']);
        });
    }
}
