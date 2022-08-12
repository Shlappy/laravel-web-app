<?php declare(strict_types=1);

namespace App\Filters\Type;

use App\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CheckboxFilter implements Filter
{
    public function filter(Builder $builder, array $data): void
    {
        $builder->whereIn('slug', $data['values'])
            ->whereHas('filter', function (Builder $query) use ($data) {
                $query->where('slug', $data['slug']);
            });
    }
}
