<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNewParked extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_new_parked', function (Blueprint $table) {
            $table->integer('user_id', false, true)->comment("ID from users table");
            $table->integer('new_id', false, true)->comment("ID from news table");
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('new_id')->references('id')
                ->on('news')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(["user_id","new_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_new_parked');
    }
}
