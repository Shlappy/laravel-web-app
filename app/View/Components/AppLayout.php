<?php

namespace App\View\Components;

use Illuminate\View\Component;
use JavaScript;
use Cart;

class AppLayout extends Component
{
  /**
   * Get the view / contents that represents the component.
   *
   * @return \Illuminate\View\View
   */
  public function render()
  {
    JavaScript::put([
      'cartCount' => Cart::getTotalQuantity(),
      'cartSubTotal' => format_price(Cart::getTotal()),
      'cartList' => Cart::getContentForOutput(),
    ]);

    return view('layout.app');
  }
}
