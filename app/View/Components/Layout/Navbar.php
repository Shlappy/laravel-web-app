<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Navbar extends Component
{
  // todo: change list from admin page
  public array $navbarItems = [];

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->navbarItems = [
      ['label' => 'Home', 'href' => '/'],
      ['label' => 'Catalog', 'href' => '/catalog'],
      ['label' => 'Products', 'href' => '/products'],
      ['label' => 'About', 'href' => '/about'],
      ['label' => 'Other projects', 'href' => '/other'],
    ];
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('layout.navbar');
  }
}
