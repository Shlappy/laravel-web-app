<?php

namespace App\View\Components\Products;

use Illuminate\View\Component;

class FilterItem extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(public array $filter)
  {
    // dd($this->filter);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product.filter-item');
  }
}
