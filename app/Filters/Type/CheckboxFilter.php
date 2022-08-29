<?php declare(strict_types=1);

namespace App\Filters\Type;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CheckboxFilter implements Filter
{
    public function filter(Builder $builder, array $data, $table = 'filter_options'): void
    {
        $builder->whereIn($table.'.slug', $data['values'])
            ->whereHas('filter', function (Builder $query) use ($data) {
                $query->where('filters.slug', $data['slug']);
            });
    }
}
