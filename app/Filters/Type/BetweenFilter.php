<?php declare(strict_types=1);

namespace App\Filters\Type;

use Illuminate\Database\Eloquent\Builder;
use App\Contracts\Filter;

class BetweenFilter implements Filter
{
    public function filter(Builder $builder, array $data): void
    {
        $builder->whereBetween('numeric_value', $data['values'])
            ->whereHas('filter', function (Builder $query) use ($data) {
                $query->where('filters.slug', $data['slug']);
            });
    }
}
