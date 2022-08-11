<?php declare(strict_types=1);

namespace App\Filters;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class OrderFilter implements Filter
{
    public function filter(Builder $builder, string $value)
    {
        $builder->orderBy($value, 'desc');
    }
}