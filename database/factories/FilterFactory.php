<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilterSeederFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return randomFilter();
  }

  public function randomFilter()
  {
    $filter_data = [];
    $type = [
      'select',
      'list',
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

    $rand_type = rand(0, 3);
    $current_type = $type[$rand_type];
    switch ($type[$rand_type]) {
      case 'select':

        break;

      case 'list':

        break;

      case 'between':
        $filter_data = [
          'name' => $name[$current_type][rand(0, count($name[$current_type]) - 1)],
          'type' => $current_type,
          'value' => (string) rand(1, 10000)
        ];
        break;

      case 'checkbox':

        break;
    }

    return $filter_data;
  }
}
