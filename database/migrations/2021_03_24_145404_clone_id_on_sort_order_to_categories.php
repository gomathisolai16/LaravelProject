<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Category;

class CloneIdOnSortOrderToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            foreach(Category::whereRaw('1 = 1')->cursor() as $category) {
                $category->sort_order = $category->id;
                $category->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            foreach(Category::whereRaw('1 = 1')->cursor() as $category) {
                $category->sort_order = 0;
                $category->save();
            }
        });
    }
}
