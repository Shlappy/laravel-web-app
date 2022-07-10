<?php

namespace App\View\Components\Products;

use Illuminate\View\Component;

class ProductItem extends Component
{
  public string $price;
  public string $oldPrice;
  public ?array $images;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(
    public string $name = '',
    $images = null,
    $price = null,
    $oldPrice = null
  ) {
    $this->price = convert_format_price($price);
    $this->oldPrice = convert_format_price($oldPrice);
    $this->images = is_null($images) ? [] : json_decode($images);
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
