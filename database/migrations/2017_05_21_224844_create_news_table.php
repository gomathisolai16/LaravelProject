<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('percentage', 20)->nullable();
            $table->longText('description');
            $table->text('meta_keywords')->nullable();
            $table->boolean('top')->default(true);
            $table->boolean('active')->default(true);
            $table->boolean('show_in_editor')->default(false);
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE '.env('DB_PREFIX').'news ADD FULLTEXT full(title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
