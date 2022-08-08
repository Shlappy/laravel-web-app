<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filters\Filter;
use App\Models\Filters\FilterOption;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Str;

class FilterOptionSeeder extends Seeder
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

    private int $count = 450;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('category_filter')->truncate();
        DB::table('filter_options')->truncate();
        DB::table('filter_option_product')->truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < $this->count; $i++) {
            $filter = Filter::inRandomOrder()->firstOrFail();
            $product = Product::inRandomOrder()->firstOrFail();

            $optionFilter = $this->createFilterOption($filter);

            $optionFilter->products()->attach($product->id);

            // Fill category_filter table
            if (!$optionFilter->filter->category()->where('category_id', $product->category_id)->exists()) {
                $optionFilter->filter->category()->attach($product->category_id);
            }
        }
    }

    public function createFilterOption($filter)
    {
        $filterData = [
            'filter_id' => $filter->id
        ];

        switch ($filter->type) {
            case 'between':
                $filterData += [
                    'numeric_value' => rand(1, 10000)
                ];

                $filterData += ['slug' => Str::slug($filterData['numeric_value'])];
                break;

            case 'checkbox':
            case 'select':
                $filterData += [
                    'string_value' => $this->values[$filter->name][rand(0, count($this->values[$filter->name]) - 1)]
                ];

                $filterData += ['slug' => Str::slug($filterData['string_value'])];
                break;

            case 'list':
                break;
        }

        if (isset($filterData['numeric_value'])) {
            return FilterOption::firstOrCreate(
                ['numeric_value' => $filterData['numeric_value']],
                ['slug' => $filterData['slug'], 'filter_id' => $filterData['filter_id']]
            );
        }
        if (isset($filterData['string_value'])) {
            return FilterOption::firstOrCreate(
                ['string_value' => $filterData['string_value']],
                ['slug' => $filterData['slug'], 'filter_id' => $filterData['filter_id']]
            );
        }
    }
}
