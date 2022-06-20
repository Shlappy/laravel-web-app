<?php

namespace App\View\Components\Products;

use Illuminate\View\Component;

class ProductItem extends Component
{
  public string $price;
  public string $oldPrice;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(
    public string $name = '',
    public ?string $images = '',
    $price = null,
    $oldPrice = null
  ) {
    $this->price = convert_format_price($price);
    $this->oldPrice = convert_format_price($oldPrice);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product.product-item');
  }
}
