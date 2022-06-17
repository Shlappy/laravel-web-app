<?php

namespace App\View\Components\Products;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryTree extends Component
{
  public array $categories;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(array $categories = [], public bool $withChildren = false) {
    $this->categories = empty($categories) 
      ? Category::where('parent_id', null)->get()->all()
      : $categories;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product.category-tree', compact($this->categories));
  }
}
