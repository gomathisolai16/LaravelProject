<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->comment("ID from users table");
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('abbreviation', 120);
            $table->string('name', 160);
            $table->boolean('preset')->default(false);
            $table->boolean('public')->default(true);
            $table->boolean('active')->default(true);
            $table->unique(['user_id','name']);
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
        Schema::dropIfExists('dashboards');
    }
}
