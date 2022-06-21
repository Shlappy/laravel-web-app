<?php

namespace App\View\Components\Products;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Filters extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(public ?Collection $filters) {
    $this->filters = $this->prepareFilters($this->filters);
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product.filters');
  }

  /**
   * Prepare filters for output to a component
   * 
   * @param Collection $filters Raw filters
   */
  protected function prepareFilters($filters)
  {
    $filters = $filters->groupBy('name');

    foreach ($filters as $name => $filter) {
      $filterValues = [];

      switch ($filter->first()->type) {
        case 'between':

          foreach ($filter as $filterItem) {
            $betweenValues[] = $filterItem->value;
          }

          $outputData = [
            'name' => $name,
            'slug' => $filter->first()->slug,
            'min' => min($betweenValues),
            'max' => max($betweenValues),
          ];

          break;
        
        default:
          break;
      }
    }

    dd($outputData);

    return $filters;
  }
}
