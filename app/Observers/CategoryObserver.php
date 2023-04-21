<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver {
  /**
   * Listen to the Category created event.
   *
   * @param  Category $category
   * @return void
   */
  public function created(Category $category) {
    $category->sort_order = $category->id;
    $category->save();
  }
}
