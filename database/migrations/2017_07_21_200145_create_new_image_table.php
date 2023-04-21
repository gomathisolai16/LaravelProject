<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_image', function (Blueprint $table) {
            $table->integer('new_id', false, true)->comment("ID from news table");
            $table->integer('image_id', false, true)->comment("ID from images table");
            $table->foreign('new_id')->references('id')
                ->on('news')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('image_id')->references('id')
                ->on('images')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['new_id','image_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_image');
    }
}
