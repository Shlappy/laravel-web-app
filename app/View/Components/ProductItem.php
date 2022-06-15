<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductItem extends Component
{
  public int $price;
  public int $oldPrice;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(
    public string $name = '',
    $price = 0,
    $oldPrice = 0
  ) {
    $this->price = convert_price($price);
    $this->oldPrice = convert_price($oldPrice);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product-item');
  }
}
