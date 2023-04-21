<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModuleCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_category', function (Blueprint $table) {
            $table->integer('module_id', false, true)->comment('ID from modules table');
            $table->integer('category_id', false, true)->comment('ID from categories table');
            $table->foreign('module_id')->references('id')
                ->on('modules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_category');
    }
}
