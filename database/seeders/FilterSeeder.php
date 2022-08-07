<?php

namespace Database\Seeders;

use App\Models\Filters\Filter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DB;
use Str;

class FilterSeeder extends Seeder
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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('filters')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach ($this->filters as $type => $filter) {
            foreach ($filter as $value) {
                Filter::firstOrCreate(
                    ['name' => $value],
                    ['type' => $type, 'slug' => Str::slug($value)]
                );
            }
        }
    }
}
