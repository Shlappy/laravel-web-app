<?php

namespace Database\Factories\Filters;

use App\Models\Filters\Filter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filters\Filter>
 */
class FilterFactory extends Factory
{
    private $filters = [
        'between' => [
            'Ширина, мм',
            'Высота, мм',
            'Глубина, мм',
        ],
        'checkbox' => [
            'Страна',
            'Производитель',
            'Бренд',
            'Подсветка',
        ]
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $i = 0;

        foreach ($this->filters as $type => $filter) {
            foreach ($filter as $value) {
                Filter::firstOrCreate(
                    ['name' => $value],
                    ['type' => $type, 'slug' => Str::slug($value)]
                );
            }
        }

        return [];
    }
}
