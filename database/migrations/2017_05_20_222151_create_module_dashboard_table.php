<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_dashboard', function (Blueprint $table) {
            $table->integer('dashboard_id',false,true)
                ->comment('ID from dashboards table');
            $table->integer('module_id',false,true)
                ->comment('ID from modules table');
            $table->tinyInteger('pos_x');
            $table->tinyInteger('pos_y');
            $table->tinyInteger('width');
            $table->tinyInteger('height');
            $table->foreign('dashboard_id')
                ->references('id')->on('dashboards')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('module_id')
                ->references('id')->on('modules')
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
        Schema::dropIfExists('module_dashboard');
    }
}
