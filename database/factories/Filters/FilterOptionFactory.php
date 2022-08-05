<?php

namespace Database\Factories\Filters;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilterOptionFactory extends Factory
{

  /**
   * Factory for Filter and FilterOption models
   */

  public array $type = [
    // 'select',
    'between',
    'checkbox'
  ];

  public array $name = [
    'between' => [
      'Ширина, мм',
      'Высота, мм',
      'Глубина, мм'
    ],
    'checkbox' => [
      'Страна',
      'Производитель',
      'Бренд',
      'Подсветка'
    ],
    // 'select' => [
    //   'Размер'
    // ]
  ];

  public array $values = [
    'Страна' => [
      'Россия',
      'Германия',
      'США',
      'Индия',
      'Китай',
      'Япония'
    ],
    'Производитель' => [
      'LongEx',
      'DurableX',
      'Tetra-Extra',
      'Infomial'
    ],
    'Бренд' => [
      'NURX',
      'Flex',
      'Reestore',
      'Niles'
    ],
    'Подсветка' => [
      'Да',
      'Нет'
    ],
    'Размер' => [
      '32 XL',
      '44',
      '12 L',
      '31'
    ]
  ];

  private string $currentType;
  private string $filterName;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $filterId = $this->createFilters();
    return $this->createFilterOptions($filterId);
  }

  /**
   * Create or update filters and return id
   * 
   * @return int Filter id
   */
  public function createFilters()
  {
    $randType = rand(0, count($this->type) - 1); // List, between, select etc.
    $this->currentType = $this->type[$randType];
    $this->filterName = $this->name[$this->currentType][rand(0, count($this->name[$this->currentType]) - 1)]; // Random name

    // Check if filter name exists and return it's id
    $filter = DB::table('filters')->where('name', $this->filterName)->first();
    if (!is_null($filter)) return $filter->id;

    // Otherwise create record and return id
    return DB::table('filters')
      ->insertGetId([
        'name' => $this->filterName,
        'type' => $this->currentType,
        'slug' => Str::slug($this->filterName),
      ]);
  }

  public function createFilterOptions($filterId)
  {
    $filterData = [
      'filter_id' => $filterId,
    ];

    switch ($this->currentType) {
      case 'between':
        $filterData += [
          'numeric_value' => rand(1, 10000)
        ];

        $filterData += ['slug' => Str::slug($filterData['numeric_value'])];
        break;

      case 'checkbox':
      case 'select':
        $filterData += [
          'string_value' => $this->values[$this->filterName][rand(0, count($this->values[$this->filterName]) - 1)]
        ];

        $filterData += ['slug' => Str::slug($filterData['string_value'])];
        break;

      case 'list':
        break;
    }

    return $filterData;
  }
}
