<?php declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Filters\FilterOption;

class ProductFilter
{
    private const FILTERS_PATH = "\\App\Filters\\Type\\";

    private int $filtersCount;

    public function __construct(private array $declaredFilters)
    {
        $this->filtersCount = count($this->declaredFilters);
    }

    public function filter(Builder $builder)
    {
        $filterOptions = FilterOption::select('op.product_id', 'p.category_id' ,'p.price', 'p.old_price', 'p.name', 'p.slug', 'p.images', 'p.id')
            ->join('filter_option_product as op', 'op.filter_option_id', '=', 'filter_options.id')
            ->join('products as p', 'p.id', '=', 'op.product_id')
            ->groupBy('op.product_id', 'filter_options.filter_id')
            ->where(function (Builder $query) {
                foreach ($this->declaredFilters as $index => $data) {
                    $filterQuery = function (Builder $query) use ($data) {
                        $this->resolveFilterClass($data['type'])->filter($query, $data);
                    };

                    if ($index >= 1) {
                        $query->orWhere($filterQuery);
                    } else {
                        $query->where($filterQuery);
                    }
                }
            });

        $builder->select('*', DB::raw('count(*) as count'))
            ->fromSub($filterOptions ,'s')
            ->groupBy('product_id')
            ->having('count', '=', $this->filtersCount);
    }

    public function resolveFilterClass($declaredFilterKey)
    {
        $filterType = Str::studly($declaredFilterKey);
        $className = static::FILTERS_PATH . $filterType . "Filter";
        $classInstance = app($className);
        return $classInstance;
    }
}
