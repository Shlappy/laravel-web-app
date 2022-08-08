<?php declare(strict_types=1);

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;

class TestFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('category_id', 1);
    }
}