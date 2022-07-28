<?php

namespace App\View\Components\Products;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Filters extends Component
{
  public array $filters;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(Collection $filters) {
    $this->filters = $this->prepareFilters($filters);
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
    $outputFilters = [];

    foreach ($filters as $name => $filter) {

      $filterData = [
        'name' => $name,
        'slug' => $filter->first()->slug,
        'type' => $filter->first()->type,
      ];

      switch ($filter->first()->type) {
        case 'between':
          $betweenValues = [];

          foreach ($filter as $filterItem) {
            $betweenValues[] = $filterItem->value;
          }

          $filterData += [
            'min' => min($betweenValues),
            'max' => max($betweenValues),
          ];
          
          break;
        
        case 'checkbox':
          $filterData['values'] = [];

          foreach ($filter as $filterItem) {
            if (array_key_exists($filterItem->value, $filterData['values'])) continue;
            $filterData['values'][$filterItem->value] = [
              'value' => $filterItem->value,
              'code' => $filterItem->code,
            ];
          }

          break;
          
        default:
          break;
      }

      $outputFilters[] = $filterData;
    }

    return $outputFilters;
  }
}
