<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilterFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return $this->randomFilter();
  }

  public function randomFilter()
  {
    $type = [
      'select',
      // 'list',
      'between',
      'checkbox'
    ];

    $name = [
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

    $values = [
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

    $rand_type = rand(0, count($type) - 1);
    $current_type = $type[$rand_type];

    $filter_name = $name[$current_type][rand(0, count($name[$current_type]) - 1)];
    $filter_data = [
      'type' => $current_type,
      'product_id' => \App\Models\Product::inRandomOrder()->first()->id,
      // 'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
      'name' => $filter_name
    ];

    switch ($current_type) {
      case 'between':
        $filter_data += [
          'value' => (string) rand(1, 10000),
        ];
        break;

      case 'checkbox': 
      case 'select':
        $filter_data += [
          'value' => $values[$filter_name][rand(0, count($values[$filter_name]) - 1)],
        ];
        break;

      case 'list':
        break;
    }

    return $filter_data;
  }
}
