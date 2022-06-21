<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilterFactory extends Factory
{

  public array $type = [
    'select',
    // 'list',
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
    'select' => [
      'Размер'
    ]
    // 'list' => []
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

  public string $currentType;
  public string $specName;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $specId = $this->createFilterSpec();
    return $this->randomFilter($specId);
  }

  /**
   * Create or update filter spec a nd return id
   * 
   * @return int Spec id
   */
  public function createFilterSpec()
  {
    $randType = rand(0, count($this->type) - 1); // List, between, select etc.
    $this->currentType = $this->type[$randType]; 
    $this->specName = $this->name[$this->currentType][rand(0, count($this->name[$this->currentType]) - 1)]; // Random name

    // Check if spec name exists and return it's id
    $spec = DB::table('filter_specs')->where('name', $this->specName)->first();
    if (!is_null($spec)) return $spec->id;

    // Otherwise create record and return id
    return DB::table('filter_specs')
      ->insertGetId([
        'name' => $this->specName,
        'type' => $this->currentType,
        'slug' => Str::slug($this->specName),
      ]);
  }

  public function randomFilter($specId)
  {
    $product = \App\Models\Product::inRandomOrder()->first();

    $filterData = [
      'product_id' => $product->id,
      'category_id' => $product->category_id,
      'specs_id' => $specId,
    ];

    switch ($this->currentType) {
      case 'between':
        $filterData += [
          'value' => (string) rand(1, 10000)
        ];
        break;

      case 'checkbox': 
      case 'select':
        $filterData += [
          'value' => $this->values[$this->specName][rand(0, count($this->values[$this->specName]) - 1)]
        ];
        break;

      case 'list':
        break;
    }

    $filterData += ['code' => Str::slug($filterData['value'])];
    return $filterData;
  }
}
